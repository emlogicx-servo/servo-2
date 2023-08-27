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
        "type": "number",
        "name": "updated_po_item_id"
      },
      {
        "type": "datetime",
        "name": "updated_time"
      },
      {
        "type": "number",
        "name": "updated_product_id"
      },
      {
        "type": "number",
        "name": "updated_po_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_po_quantity_edit",
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
              "column": "updated_po_item_id",
              "type": "number",
              "value": "{{$_POST.updated_po_item_id}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_value",
              "type": "text",
              "value": "Quantity"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_time",
              "type": "datetime",
              "value": "{{$_POST.updated_time}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_product_id",
              "type": "number",
              "value": "{{$_POST.updated_product_id}}"
            },
            {
              "table": "servo_changes_updates",
              "column": "updated_po_id",
              "type": "number",
              "value": "{{$_POST.updated_po_id}}"
            }
          ],
          "table": "servo_changes_updates",
          "returning": "update_id",
          "query": "insert into `servo_changes_updates` (`new_value`, `old_value`, `updated_po_id`, `updated_po_item_id`, `updated_product_id`, `updated_time`, `updated_value`, `user_updated`) values (?, ?, ?, ?, ?, ?, ?, ?)",
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
              "value": "{{$_POST.updated_po_item_id}}",
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
              "value": "{{$_POST.updated_product_id}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.updated_po_id}}",
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