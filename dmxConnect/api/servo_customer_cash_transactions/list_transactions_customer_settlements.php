<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "customer_id"
      },
      {
        "type": "text",
        "name": "transaction_type"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_amount"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_payment_method"
            }
          ],
          "table": {
            "name": "servo_customer_cash_transaction",
            "alias": "servo_customer_cash_transaction"
          },
          "primary": "customer_transaction_id",
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customer_cash_transaction.customer_id",
                "field": "servo_customer_cash_transaction.customer_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer_id}}",
                "data": {
                  "table": "servo_customer_cash_transaction",
                  "column": "customer_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "customer_id",
                    "inTable": "servo_customers",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "referenceType": "integer",
                    "name": "customer_id"
                  }
                },
                "operation": "="
              },
              {
                "id": "servo_customer_cash_transaction.transaction_type",
                "field": "servo_customer_cash_transaction.transaction_type",
                "type": "string",
                "operator": "equal",
                "value": "Settlement",
                "data": {
                  "table": "servo_customer_cash_transaction",
                  "column": "transaction_type",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "maxLength": 65535,
                    "primary": false,
                    "nullable": false,
                    "name": "transaction_type"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT transaction_amount, transaction_payment_method\nFROM servo_customer_cash_transaction AS servo_customer_cash_transaction\nWHERE customer_id = :P1 /* {{$_GET.customer_id}} */ AND transaction_type = 'Settlement'",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "transaction_amount"
        },
        {
          "type": "number",
          "name": "transaction_payment_method"
        }
      ],
      "outputType": "array",
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>