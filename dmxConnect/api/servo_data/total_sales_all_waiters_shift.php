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
      },
      {
        "type": "text",
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "current_shift"
      }
    ],
    "$_SESSION": [
      {
        "type": "text",
        "name": "user_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "total_sales_all_waiters_shift",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select transaction_amount as Payments, order_status from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\n\nwhere servo_shift_shift_id = :P1\n\n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.current_shift}}",
              "test": "36"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "Payments",
          "type": "number"
        },
        {
          "name": "order_status",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>