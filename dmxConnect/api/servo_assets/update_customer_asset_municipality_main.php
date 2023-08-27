<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "asset_name"
      },
      {
        "type": "text",
        "name": "asset_lat"
      },
      {
        "type": "text",
        "name": "asset_long"
      },
      {
        "type": "number",
        "name": "asset_owner"
      },
      {
        "type": "datetime",
        "name": "date_created"
      },
      {
        "type": "number",
        "name": "user_created"
      },
      {
        "type": "number",
        "name": "asset_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_customer_asset_muicipality_main",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_assets",
              "column": "asset_name",
              "type": "text",
              "value": "{{$_POST.asset_name}}"
            },
            {
              "table": "servo_assets",
              "column": "asset_lat",
              "type": "text",
              "value": "{{$_POST.asset_lat}}"
            },
            {
              "table": "servo_assets",
              "column": "asset_long",
              "type": "text",
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
              "column": "date_created",
              "type": "datetime",
              "value": "{{$_POST.date_created}}"
            },
            {
              "table": "servo_assets",
              "column": "user_created",
              "type": "number",
              "value": "{{$_POST.user_created}}"
            }
          ],
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
          "query": "UPDATE servo_assets\nSET asset_name = :P1 /* {{$_POST.asset_name}} */, asset_lat = :P2 /* {{$_POST.asset_lat}} */, asset_long = :P3 /* {{$_POST.asset_long}} */, asset_owner = :P4 /* {{$_POST.asset_owner}} */, date_created = :P5 /* {{$_POST.date_created}} */, user_created = :P6 /* {{$_POST.user_created}} */\nWHERE asset_id = :P7 /* {{$_POST.asset_id}} */",
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
              "value": "{{$_POST.date_created}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.user_created}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P7",
              "value": "{{$_POST.asset_id}}"
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