<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "po_product_id"
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
        "type": "text",
        "name": "po_item_notes"
      },
      {
        "type": "number",
        "name": "po_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_po_item",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_purchase_order_items",
              "column": "po_product_id",
              "type": "number",
              "value": "{{$_POST.po_product_id}}"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_quantity",
              "type": "number",
              "value": "{{$_POST.po_item_quantity}}"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_price",
              "type": "number",
              "value": "{{$_POST.po_item_price}}"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_notes",
              "type": "text",
              "value": "{{$_POST.po_item_notes}}"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_id",
              "type": "number",
              "value": "{{$_POST.po_id}}"
            }
          ],
          "table": "servo_purchase_order_items",
          "returning": "po_item_id",
          "query": "INSERT INTO servo_purchase_order_items\n(po_product_id, po_item_quantity, po_item_price, po_item_notes, po_id) VALUES (:P1 /* {{$_POST.po_product_id}} */, :P2 /* {{$_POST.po_item_quantity}} */, :P3 /* {{$_POST.po_item_price}} */, :P4 /* {{$_POST.po_item_notes}} */, :P5 /* {{$_POST.po_id}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.po_product_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.po_item_quantity}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.po_item_price}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.po_item_notes}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.po_id}}"
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