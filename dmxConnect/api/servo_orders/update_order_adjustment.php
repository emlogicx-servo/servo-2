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
        "name": "order_notes"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_order_adjustment",
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
          "query": "UPDATE servo_orders\nSET order_status = :P1 /* {{$_POST.order_status}} */, order_notes = :P2 /* {{$_POST.order_notes}} */\nWHERE order_id = :P3 /* {{$_POST.order_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_status}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.order_notes}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>