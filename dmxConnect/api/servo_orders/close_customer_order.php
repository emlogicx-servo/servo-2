<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "order_id"
      },
      {
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "text",
        "name": "servo_users_cashier_id"
      },
      {
        "type": "datetime",
        "name": "order_time_paid"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_order_to_paid_customer",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_orders",
              "column": "order_status",
              "type": "text",
              "value": "{{$_POST.order_status}}"
            },
            {
              "table": "servo_orders",
              "column": "servo_users_cashier_id",
              "type": "number",
              "value": "{{$_POST.servo_users_cashier_id}}"
            },
            {
              "table": "servo_orders",
              "column": "order_time_paid",
              "type": "datetime",
              "value": "{{$_POST.order_time_paid}}"
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
          "query": "UPDATE servo_orders\nSET order_status = :P1 /* {{$_POST.order_status}} */, servo_users_cashier_id = :P2 /* {{$_POST.servo_users_cashier_id}} */, order_time_paid = :P3 /* {{$_POST.order_time_paid}} */\nWHERE order_id = :P4 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_status}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.servo_users_cashier_id}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.order_time_paid}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
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