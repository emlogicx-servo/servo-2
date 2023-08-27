<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "customer_id"
      },
      {
        "type": "number",
        "name": "transaction_amount"
      },
      {
        "type": "text",
        "name": "transaction_type"
      },
      {
        "type": "number",
        "name": "user_approved_id"
      },
      {
        "type": "datetime",
        "name": "transaction_date"
      },
      {
        "type": "number",
        "name": "customer_transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_customer_cash_transaction",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_customer_cash_transaction",
              "column": "customer_id",
              "type": "number",
              "value": "{{$_POST.customer_id}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_amount",
              "type": "number",
              "value": "{{$_POST.transaction_amount}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_type",
              "type": "text",
              "value": "{{$_POST.transaction_type}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "user_approved_id",
              "type": "number",
              "value": "{{$_POST.user_approved_id}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_date",
              "type": "datetime",
              "value": "{{$_POST.transaction_date}}"
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
          "query": "UPDATE servo_customer_cash_transaction\nSET customer_id = :P1 /* {{$_POST.customer_id}} */, transaction_amount = :P2 /* {{$_POST.transaction_amount}} */, transaction_type = :P3 /* {{$_POST.transaction_type}} */, user_approved_id = :P4 /* {{$_POST.user_approved_id}} */, transaction_date = :P5 /* {{$_POST.transaction_date}} */\nWHERE customer_transaction_id = :P6 /* {{$_POST.customer_transaction_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.customer_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.transaction_amount}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.transaction_type}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.user_approved_id}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.transaction_date}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.customer_transaction_id}}"
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