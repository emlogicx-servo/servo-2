<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_floor_name"
      },
      {
        "type": "number",
        "name": "asset_floor_number"
      },
      {
        "type": "number",
        "name": "asset_floor_surface_area"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_asset_floor",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_floor_name",
              "type": "text",
              "value": "{{$_POST.asset_floor_name}}"
            },
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_floor_number",
              "type": "number",
              "value": "{{$_POST.asset_floor_number}}"
            },
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_floor_surface_area",
              "type": "number",
              "value": "{{$_POST.asset_floor_surface_area}}"
            }
          ],
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
          "query": "update `servo_asset_floors_cc` set `asset_floor_name` = ?, `asset_floor_number` = ?, `asset_floor_surface_area` = ? where `asset_floor_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.asset_floor_name}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.asset_floor_number}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.asset_floor_surface_area}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
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