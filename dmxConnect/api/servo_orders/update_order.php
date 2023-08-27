<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "order_discount"
      },
      {
        "type": "number",
        "name": "servo_customer_table_table_id"
      },
      {
        "type": "text",
        "name": "order_notes"
      },
      {
        "type": "number",
        "name": "order_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_order",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_orders",
              "column": "order_discount",
              "type": "number",
              "value": "{{$_POST.order_discount}}"
            },
            {
              "table": "servo_orders",
              "column": "servo_customer_table_table_id",
              "type": "number",
              "value": "{{$_POST.servo_customer_table_table_id}}"
            },
            {
              "table": "servo_orders",
              "column": "order_notes",
              "type": "text",
              "value": "{{$_POST.order_notes}}"
            }
          ],
          "table": "servo_orders",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.order_id}}",
                "data": {
                  "column": "order_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_orders\nSET order_discount = :P1 /* {{$_POST.order_discount}} */, servo_customer_table_table_id = :P2 /* {{$_POST.servo_customer_table_table_id}} */, order_notes = :P3 /* {{$_POST.order_notes}} */\nWHERE order_id = :P4 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_discount}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.servo_customer_table_table_id}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.order_notes}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
              "value": "{{$_POST.order_id}}"
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