<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "po_item_quantity"
      },
      {
        "type": "number",
        "name": "po_item_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_quantity",
              "type": "number",
              "value": "{{$_POST.po_item_quantity}}"
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
          "query": "UPDATE servo_purchase_order_items\nSET po_item_quantity = :P1 /* {{$_POST.po_item_quantity}} */\nWHERE po_item_id = :P2 /* {{$_POST.po_item_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.po_item_quantity}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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