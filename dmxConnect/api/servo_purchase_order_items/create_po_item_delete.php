<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "po_id"
      },
      {
        "type": "number",
        "name": "po_item_quantity"
      },
      {
        "type": "number",
        "name": "po_item_price"
      },
      {
        "type": "number",
        "name": "po_user_deleted"
      },
      {
        "type": "datetime",
        "name": "po_item_time_deleted"
      },
      {
        "type": "number",
        "name": "po_item_deleted_product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_order_item_delete",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_id",
              "type": "number",
              "value": "{{$_POST.po_item_id}}"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_id",
              "type": "number",
              "value": "{{$_POST.po_id}}"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_quantity",
              "type": "number",
              "value": "{{$_POST.po_item_quantity}}"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_price",
              "type": "number",
              "value": "{{$_POST.po_item_price}}"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_user_deleted",
              "type": "number",
              "value": "{{$_POST.po_user_deleted}}"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_time_deleted",
              "type": "datetime",
              "value": "{{$_POST.po_item_time_deleted}}"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_deleted_product_id",
              "type": "number",
              "value": "{{$_POST.po_item_deleted_product_id}}"
            }
          ],
          "table": "servo_purchase_order_item_deletes",
          "returning": "po_item_delete_id",
          "query": "insert into `servo_purchase_order_item_deletes` (`po_id`, `po_item_deleted_product_id`, `po_item_id`, `po_item_price`, `po_item_quantity`, `po_item_time_deleted`, `po_user_deleted`) values (?, ?, ?, ?, ?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.po_item_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.po_id}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.po_item_quantity}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.po_item_price}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.po_user_deleted}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.po_item_time_deleted}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.po_item_deleted_product_id}}",
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