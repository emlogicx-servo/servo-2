<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "order_id"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "text",
        "name": "order_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_order_paid_ordered",
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
              "value": "Ordered"
            }
          ],
          "table": "servo_orders",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "order_id",
                "field": "order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.order_id}}",
                "data": {
                  "column": "order_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "UPDATE servo_orders\nSET order_status = 'Ordered'\nWHERE order_id = :P1 /* {{$_POST.order_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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