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
        "type": "number",
        "name": "coverage_partner"
      },
      {
        "type": "number",
        "name": "coverage_percentage"
      },
      {
        "type": "text",
        "name": "coverage_payment_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_order_coverage_partner",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_orders",
              "column": "coverage_partner",
              "type": "number",
              "value": "{{$_POST.coverage_partner}}"
            },
            {
              "table": "servo_orders",
              "column": "coverage_percentage",
              "type": "number",
              "value": "{{$_POST.coverage_percentage}}"
            },
            {
              "table": "servo_orders",
              "column": "coverage_payment_status",
              "type": "text",
              "value": "{{$_POST.coverage_payment_status}}"
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
          "query": "UPDATE servo_orders\nSET coverage_partner = :P1 /* {{$_POST.coverage_partner}} */, coverage_percentage = :P2 /* {{$_POST.coverage_percentage}} */, coverage_payment_status = :P3 /* {{$_POST.coverage_payment_status}} */\nWHERE order_id = :P4 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.coverage_partner}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.coverage_percentage}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.coverage_payment_status}}"
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