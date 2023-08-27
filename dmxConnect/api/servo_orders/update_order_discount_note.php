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
      },
      {
        "type": "text",
        "name": "order_extra_info"
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
              "column": "order_notes",
              "type": "text",
              "value": "{{$_POST.order_notes}}"
            },
            {
              "table": "servo_orders",
              "column": "order_customer",
              "type": "number",
              "value": "{{$_POST.order_customer}}"
            },
            {
              "table": "servo_orders",
              "column": "order_discount",
              "type": "number",
              "value": "{{$_POST.order_discount}}"
            },
            {
              "table": "servo_orders",
              "column": "order_extra_info",
              "type": "text",
              "value": "{{$_POST.order_extra_info}}"
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
          "query": "UPDATE servo_orders\nSET order_notes = :P1 /* {{$_POST.order_notes}} */, order_customer = :P2 /* {{$_POST.order_customer}} */, order_discount = :P3 /* {{$_POST.order_discount}} */, order_extra_info = :P4 /* {{$_POST.order_extra_info}} */\nWHERE order_id = :P5 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_notes}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.order_customer}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.order_discount}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.order_extra_info}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_POST.order_id}}",
              "test": ""
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