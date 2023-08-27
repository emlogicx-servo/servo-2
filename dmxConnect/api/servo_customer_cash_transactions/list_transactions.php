<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_customer_cash_transactions",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customer_cash_transaction",
            "alias": "servo_customer_cash_transaction"
          },
          "primary": "customer_transaction_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_customer_cash_transaction AS servo_customer_cash_transaction",
          "params": []
        },
        "connection": "servodb"
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>