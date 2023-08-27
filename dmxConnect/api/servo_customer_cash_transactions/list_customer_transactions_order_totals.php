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
    ]
  },
  "exec": {
    "steps": {
      "name": "custom_list_customer_transactions_order_totals",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Settlement' and transaction_order = :P1) as 'Settlements', \n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Coverage Settlement' and transaction_order = :P1) as 'Coverage Settlements',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Payment' and transaction_order = :P1) as 'Coverage Payments',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Deposit' and transaction_order = :P1) as 'Deposits'",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.order_id}}",
              "test": "1190"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "Settlements",
          "type": "text"
        },
        {
          "name": "Coverage Settlements",
          "type": "text"
        },
        {
          "name": "Coverage Payments",
          "type": "text"
        },
        {
          "name": "Deposits",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>