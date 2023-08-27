<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_file_description"
      },
      {
        "type": "number",
        "name": "asset_file_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_asset_file_description",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_asset_files",
              "column": "asset_file_description",
              "type": "text",
              "value": "{{$_POST.asset_file_description}}"
            }
          ],
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
          "query": "UPDATE servo_asset_files\nSET asset_file_description = :P1 /* {{$_POST.asset_file_description}} */\nWHERE asset_file_id = :P2 /* {{$_POST.asset_file_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.asset_file_description}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>