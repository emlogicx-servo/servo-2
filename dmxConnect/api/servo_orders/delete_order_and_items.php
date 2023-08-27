<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "order_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "delete_order_transactions",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_customer_cash_transaction",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "transaction_order",
                  "field": "transaction_order",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.order_id}}",
                  "data": {
                    "column": "transaction_order"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "customer_transaction_id",
            "query": "DELETE\nFROM servo_customer_cash_transaction\nWHERE transaction_order = :P1 /* {{$_POST.order_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.order_id}}",
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
        ]
      },
      {
        "name": "delete_order_items",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_order_items",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_orders_order_id",
                  "field": "servo_orders_order_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.order_id}}",
                  "data": {
                    "column": "servo_orders_order_id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "DELETE\nFROM servo_order_items\nWHERE servo_orders_order_id = :P1 /* {{$_POST.order_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
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
      },
      {
        "name": "delete_order",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
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
            "query": "DELETE\nFROM servo_orders\nWHERE order_id = :P1 /* {{$_POST.order_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
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
    ]
  }
}
JSON
);
?>