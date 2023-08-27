<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_file_id"
      },
      {
        "type": "text",
        "name": "asset_file"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "delete_asset_file",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_asset_files",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "asset_file_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.asset_file_id}}",
                  "data": {
                    "column": "asset_file_id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "asset_file_id",
            "query": "DELETE\nFROM servo_asset_files\nWHERE asset_file_id = :P1 /* {{$_POST.asset_file_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.asset_file_id}}"
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
          "path": "{{'/uploads/asset_files/'+$_POST.asset_file}}"
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>