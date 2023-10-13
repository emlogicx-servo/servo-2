<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "po_id"
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ],
    "$_POST": [
      {
        "type": "number",
        "name": "po_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "close_po",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_purchase_orders",
              "column": "po_payment_status",
              "type": "text",
              "value": "Paid"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_id",
              "type": "number",
              "value": "{{$_POST.po_id}}"
            }
          ],
          "table": "servo_purchase_orders",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "po_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.po_id}}",
                "data": {
                  "column": "po_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "po_id",
          "query": "update `servo_purchase_orders` set `po_payment_status` = ?, `po_id` = ? where `po_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.po_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.po_id}}",
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