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
      },
      {
        "type": "number",
        "name": "po_item_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_po_item",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
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
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "po_item_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.po_item_id}}",
                "data": {
                  "column": "po_item_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_purchase_order_items\nSET po_product_id = :P1 /* {{$_POST.po_product_id}} */, po_item_quantity = :P2 /* {{$_POST.po_item_quantity}} */, po_item_price = :P3 /* {{$_POST.po_item_price}} */, po_item_notes = :P4 /* {{$_POST.po_item_notes}} */, po_id = :P5 /* {{$_POST.po_id}} */\nWHERE po_item_id = :P6 /* {{$_POST.po_item_id}} */",
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
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.po_item_id}}"
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