<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "servo_orders_order_id"
      },
      {
        "type": "text",
        "name": "order_item_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_order_item_to_ordered",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_order_items",
              "column": "order_item_status",
              "type": "text",
              "value": "Ordered"
            }
          ],
          "table": "servo_order_items",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "order_item_status",
                "field": "order_item_status",
                "type": "string",
                "operator": "equal",
                "value": "Pending",
                "data": {
                  "column": "order_item_status"
                },
                "operation": "="
              },
              {
                "id": "servo_orders_order_id",
                "field": "servo_orders_order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.servo_orders_order_id}}",
                "data": {
                  "column": "servo_orders_order_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "order_item_id",
          "query": "UPDATE servo_order_items\nSET order_item_status = 'Ordered'\nWHERE order_item_status = 'Pending' AND servo_orders_order_id = :P1 /* {{$_POST.servo_orders_order_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.servo_orders_order_id}}",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>