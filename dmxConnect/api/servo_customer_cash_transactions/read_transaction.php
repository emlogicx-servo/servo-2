<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "customer_cash_transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customer_cash_transaction",
            "alias": "servo_customer_cash_transaction"
          },
          "primary": "customer_transaction_id",
          "joins": [
            {
              "table": "servo_payment_methods",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_payment_methods",
                    "column": "payment_method_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_customer_cash_transaction",
                      "column": "transaction_payment_method"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "payment_method_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customer_cash_transaction.customer_transaction_id",
                "field": "servo_customer_cash_transaction.customer_transaction_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer_cash_transaction_id}}",
                "data": {
                  "table": "servo_customer_cash_transaction",
                  "column": "customer_transaction_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "customer_transaction_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_customer_cash_transaction AS servo_customer_cash_transaction\nINNER JOIN servo_payment_methods ON (servo_payment_methods.payment_method_id = servo_customer_cash_transaction.transaction_payment_method)\nWHERE servo_customer_cash_transaction.customer_transaction_id = :P1 /* {{$_GET.customer_cash_transaction_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_cash_transaction_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "customer_transaction_id"
        },
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
          "name": "transaction_payment_method"
        },
        {
          "type": "text",
          "name": "transaction_status"
        },
        {
          "type": "text",
          "name": "transaction_note"
        },
        {
          "type": "number",
          "name": "transaction_order"
        },
        {
          "type": "number",
          "name": "transaction_balance"
        },
        {
          "type": "number",
          "name": "transaction_amount_tendered"
        },
        {
          "type": "number",
          "name": "payment_method_id"
        },
        {
          "type": "text",
          "name": "payment_method_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>