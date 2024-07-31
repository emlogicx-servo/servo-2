<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "asset_id"
      },
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
      "name": "create_asset_floor",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_id",
              "type": "number",
              "value": "{{$_POST.asset_id}}"
            },
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_floor_name",
              "type": "text",
              "value": "{{$_POST.asset_floor_name.default(null)}}"
            },
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_floor_number",
              "type": "number",
              "value": "{{$_POST.asset_floor_number.default(null)}}"
            },
            {
              "table": "servo_asset_floors_cc",
              "column": "asset_floor_surface_area",
              "type": "number",
              "value": "{{$_POST.asset_floor_surface_area}}"
            }
          ],
          "table": "servo_asset_floors_cc",
          "returning": "asset_floor_id",
          "query": "insert into `servo_asset_floors_cc` (`asset_floor_name`, `asset_floor_number`, `asset_floor_surface_area`, `asset_id`) values (?, ?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.asset_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.asset_floor_name.default(null)}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.asset_floor_number.default(null)}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.asset_floor_surface_area}}",
              "test": ""
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
  }
}
JSON
);
?>