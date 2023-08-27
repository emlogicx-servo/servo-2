<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "file_id"
      },
      {
        "type": "text",
        "name": "file_name"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "delete_file",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_files",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "file_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.file_id}}",
                  "data": {
                    "column": "file_id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "file_id",
            "query": "DELETE\nFROM servo_files\nWHERE file_id = :P1 /* {{$_POST.file_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.file_id}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ]
      },
      {
        "name": "fileRemove",
        "module": "fs",
        "action": "remove",
        "options": {
          "path": "{{'/uploads/files/'+$_POST.file_name}}"
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>