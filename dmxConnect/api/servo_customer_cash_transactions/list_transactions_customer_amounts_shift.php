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
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "custom_list_transaction_amounts",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n(select sum(transaction_amount) from servo_customer_cash_transaction LEFT JOIN servo_orders on order_id = transaction_order where transaction_type = 'Deposit' AND customer_id = :P1 AND servo_shift_shift_id = :P2) as 'Deposits', \n\n(select sum(transaction_amount) from servo_customer_cash_transaction LEFT JOIN servo_orders on order_id = transaction_order where transaction_type = 'Payment' AND customer_id = :P1 AND servo_shift_shift_id = :P2) as 'Payments',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction  LEFT JOIN servo_orders on order_id = transaction_order where transaction_type = 'Settlement' AND customer_id = :P1 AND servo_shift_shift_id = :P2) as 'Settlements',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction LEFT JOIN servo_orders on order_id = transaction_order where transaction_type = 'Settlement' AND transaction_payment_method = '1' AND customer_id = :P1 AND servo_shift_shift_id = :P2) as 'DepositSettlements',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction LEFT JOIN servo_orders on order_id = transaction_order where transaction_type = 'Payment' AND transaction_payment_method = '1' AND customer_id = :P1 AND servo_shift_shift_id = :P2) as 'DepositPayments',\n\n(select sum(transaction_amount) from servo_customer_cash_transaction LEFT JOIN servo_orders on order_id = transaction_order where transaction_type = 'Pending' AND customer_id = :P1 AND servo_shift_shift_id = :P2) as 'Pending'\n\n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.customer_id}}",
              "test": "7424"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.shift_id}}",
              "test": "36"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "Deposits",
          "type": "text"
        },
        {
          "name": "Payments",
          "type": "text"
        },
        {
          "name": "Settlements",
          "type": "text"
        },
        {
          "name": "DepositSettlements",
          "type": "text"
        },
        {
          "name": "DepositPayments",
          "type": "text"
        },
        {
          "name": "Pending",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>