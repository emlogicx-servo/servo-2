<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "transaction_payment_method"
      },
      {
        "type": "number",
        "name": "customer_transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_transaction_payment_method",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_payment_method",
              "type": "number",
              "value": "{{$_POST.transaction_payment_method}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "customer_transaction_id",
              "type": "number",
              "value": "{{$_POST.customer_transaction_id}}"
            }
          ],
          "table": "servo_customer_cash_transaction",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "customer_transaction_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.customer_transaction_id}}",
                "data": {
                  "column": "customer_transaction_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "customer_transaction_id",
          "query": "UPDATE servo_customer_cash_transaction\nSET transaction_payment_method = :P1 /* {{$_POST.transaction_payment_method}} */, customer_transaction_id = :P2 /* {{$_POST.customer_transaction_id}} */\nWHERE customer_transaction_id = :P3 /* {{$_POST.customer_transaction_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.transaction_payment_method}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.customer_transaction_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.customer_transaction_id}}",
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
    }
  }
}
JSON
);
?>