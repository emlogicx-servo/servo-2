<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "asset_name"
      },
      {
        "type": "number",
        "name": "asset_lat"
      },
      {
        "type": "number",
        "name": "asset_long"
      },
      {
        "type": "number",
        "name": "asset_owner"
      },
      {
        "type": "number",
        "name": "user_created"
      },
      {
        "type": "number",
        "name": "asset"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "create_asset",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_assets",
                "column": "asset_name",
                "type": "number",
                "value": "{{$_POST.asset_name}}"
              },
              {
                "table": "servo_assets",
                "column": "asset_lat",
                "type": "number",
                "value": "{{$_POST.asset_lat}}"
              },
              {
                "table": "servo_assets",
                "column": "asset_long",
                "type": "number",
                "value": "{{$_POST.asset_long}}"
              },
              {
                "table": "servo_assets",
                "column": "asset_owner",
                "type": "number",
                "value": "{{$_POST.asset_owner}}"
              },
              {
                "table": "servo_assets",
                "column": "user_created",
                "type": "number",
                "value": "{{$_POST.user_created}}"
              }
            ],
            "table": "servo_assets",
            "returning": "asset_id",
            "query": "INSERT INTO servo_assets\n(asset_name, asset_lat, asset_long, asset_owner, user_created) VALUES (:P1 /* {{$_POST.asset_name}} */, :P2 /* {{$_POST.asset_lat}} */, :P3 /* {{$_POST.asset_long}} */, :P4 /* {{$_POST.asset_owner}} */, :P5 /* {{$_POST.user_created}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.asset_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.asset_lat}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.asset_long}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.asset_owner}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.user_created}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      },
      {
        "name": "custom_get_last_insert",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "create_asset_additonal_municipality",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_asset_special_fields_municipality",
                "column": "asset",
                "type": "number",
                "value": "{{custom_get_last_insert[0]['last_insert_id()']}}"
              }
            ],
            "table": "servo_asset_special_fields_municipality",
            "query": "INSERT INTO servo_asset_special_fields_municipality\n(asset) VALUES (:P1 /* {{custom_get_last_insert[0]['last_insert_id()']}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{custom_get_last_insert[0]['last_insert_id()']}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
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