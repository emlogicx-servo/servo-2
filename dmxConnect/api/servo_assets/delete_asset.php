<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "delete_asset_fields",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_asset_special_fields_municipality",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "asset",
                  "field": "asset",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.asset_id}}",
                  "data": {
                    "column": "asset"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "asset_info_special_id",
            "query": "delete from `servo_asset_special_fields_municipality` where `asset` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.asset_id}}",
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
      },
      {
        "name": "delete_asset",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_assets",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "asset_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.asset_id}}",
                  "data": {
                    "column": "asset_id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "asset_id",
            "query": "delete from `servo_assets` where `asset_id` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.asset_id}}",
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
    ]
  }
}
JSON
);
?>