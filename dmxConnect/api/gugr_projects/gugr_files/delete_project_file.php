<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "project_file_id"
      },
      {
        "type": "text",
        "name": "project_file"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "delete_project_file",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_project_files",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "project_file_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.project_file_id}}",
                  "data": {
                    "column": "project_file_id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "project_file_id",
            "query": "DELETE\nFROM servo_project_files\nWHERE project_file_id = :P1 /* {{$_POST.project_file_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.project_file_id}}"
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
          "path": "{{'/uploads/project_files/'+$_POST.project_file}}"
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>