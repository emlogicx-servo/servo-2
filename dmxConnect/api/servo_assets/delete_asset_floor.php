<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_floor_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_asset_floor",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_asset_floors_cc",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "asset_floor_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.asset_floor_id}}",
                "data": {
                  "column": "asset_floor_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "asset_floor_id",
          "query": "delete from `servo_asset_floors_cc` where `asset_floor_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.asset_floor_id}}",
              "test": ""
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
    }
  }
}
JSON
);
?>