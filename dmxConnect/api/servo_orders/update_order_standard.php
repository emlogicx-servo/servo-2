<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "order_notes"
      },
      {
        "type": "number",
        "name": "order_id"
      },
      {
        "type": "number",
        "name": "servo_customer_table_table_id"
      },
      {
        "type": "number",
        "name": "order_customer"
      },
      {
        "type": "text",
        "name": "order_discount"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_order_standard",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
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
            },
            {
              "table": "servo_orders",
              "column": "order_customer",
              "type": "number",
              "value": "{{$_POST.order_customer.default(null)}}"
            },
            {
              "table": "servo_orders",
              "column": "order_discount",
              "type": "number",
              "value": "{{$_POST.order_discount}}"
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
          "query": "UPDATE servo_orders\nSET servo_customer_table_table_id = :P1 /* {{$_POST.servo_customer_table_table_id}} */, order_notes = :P2 /* {{$_POST.order_notes}} */, order_customer = :P3 /* {{$_POST.order_customer.default(null)}} */, order_discount = :P4 /* {{$_POST.order_discount}} */\nWHERE order_id = :P5 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.servo_customer_table_table_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.order_notes}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.order_customer.default(null)}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.order_discount}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_POST.order_id}}"
            }
          ],
          "returning": "order_id"
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