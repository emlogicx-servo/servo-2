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
        "type": "number",
        "name": "order_item_id"
      },
      {
        "type": "text",
        "name": "updated_value"
      },
      {
        "type": "datetime",
        "name": "updated_time"
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
              "column": "order_item_id",
              "type": "number",
              "value": "{{$_POST.order_item_id}}"
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
            }
          ],
          "table": "servo_changes_updates",
          "returning": "update_id",
          "query": "INSERT INTO servo_changes_updates\n(user_updated, order_item_id, updated_value, updated_time) VALUES (:P1 /* {{$_POST.user_updated}} */, :P2 /* {{$_POST.order_item_id}} */, :P3 /* {{$_POST.updated_value}} */, :P4 /* {{$_POST.updated_time}} */)",
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
              "value": "{{$_POST.order_item_id}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.updated_value}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.updated_time}}",
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