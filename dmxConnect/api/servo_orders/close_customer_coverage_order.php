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
        "name": "coverage_payment_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_coverage_order_to_paid",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_orders",
              "column": "servo_users_cashier_id",
              "type": "number",
              "value": "{{$_POST.servo_users_cashier_id}}"
            },
            {
              "table": "servo_orders",
              "column": "coverage_payment_status",
              "type": "text",
              "value": "Paid"
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
          "query": "UPDATE servo_orders\nSET servo_users_cashier_id = :P1 /* {{$_POST.servo_users_cashier_id}} */, coverage_payment_status = 'Paid'\nWHERE order_id = :P2 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.servo_users_cashier_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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