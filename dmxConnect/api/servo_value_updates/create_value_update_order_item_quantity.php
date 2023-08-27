<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "user_updated"
      },
      {
        "type": "text",
        "name": "old_value"
      },
      {
        "type": "text",
        "name": "new_value"
      },
      {
        "type": "text",
        "name": "updated_value"
      },
      {
        "type": "datetime",
        "name": "updated_time"
      },
      {
        "type": "number",
        "name": "updated_order_id"
      },
      {
        "type": "number",
        "name": "updated_order_item_id"
      },
      {
        "type": "number",
        "name": "updated_product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert_value_change_update_order_item_quantity",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_changes_updates",
              "column": "user_updated",
              "type": "number",
              "value": "{{$_POST.user_updated}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "old_value",
              "type": "text",
              "value": "{{$_POST.old_value}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "new_value",
              "type": "text",
              "value": "{{$_POST.new_value}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_value",
              "type": "text",
              "value": "{{$_POST.updated_value}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_time",
              "type": "datetime",
              "value": "{{$_POST.updated_time}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_order_id",
              "type": "number",
              "value": "{{$_POST.updated_order_id}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_order_item_id",
              "type": "number",
              "value": "{{$_POST.updated_order_item_id}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_product_id",
              "type": "number",
              "value": "{{$_POST.updated_product_id}}"
            }
          ],
          "table": "servo_changes_updates",
          "returning": "update_id",
          "query": "INSERT INTO servo_changes_updates\n(user_updated, old_value, new_value, updated_value, updated_time, updated_order_id, updated_order_item_id, updated_product_id) VALUES (:P1 /* {{$_POST.user_updated}} */, :P2 /* {{$_POST.old_value}} */, :P3 /* {{$_POST.new_value}} */, :P4 /* {{$_POST.updated_value}} */, :P5 /* {{$_POST.updated_time}} */, :P6 /* {{$_POST.updated_order_id}} */, :P7 /* {{$_POST.updated_order_item_id}} */, :P8 /* {{$_POST.updated_product_id}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_updated}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.old_value}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.new_value}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.updated_value}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.updated_time}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.updated_order_id}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.updated_order_item_id}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.updated_product_id}}",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>