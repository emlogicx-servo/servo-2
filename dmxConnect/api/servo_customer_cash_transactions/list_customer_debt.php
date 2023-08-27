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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_customer_debt",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Deposit' AND customer_id = :P1) as 'Deposits', \n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Payment' AND customer_id = :P1) as 'Payments',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Settlement' AND customer_id = :P1) as 'Settlements',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Settlement' AND transaction_payment_method = '1' AND customer_id = :P1) as 'DepositSettlements',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Payment' AND transaction_payment_method = '1' AND customer_id = :P1) as 'DepositPayments',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction where transaction_type = 'Pending' AND customer_id = :P1) as 'Pending'\n\n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.customer_id}}",
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