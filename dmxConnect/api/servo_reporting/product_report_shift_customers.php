<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "shift"
      },
      {
        "type": "text",
        "name": "department"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select sum(transaction_amount), servo_customers.customer_id, servo_customers.customer_first_name, servo_customers.customer_last_name, servo_shift_shift_id, order_id  \n\nfrom servo_customer_cash_transaction \nleft join servo_customers on servo_customers.customer_id = servo_customer_cash_transaction.customer_id \nleft join servo_orders on order_id = servo_customer_cash_transaction.transaction_order\nwhere servo_shift_shift_id = :P4\ngroup by order_id\n\n\n",
          "params": [
            {
              "name": ":P4",
              "value": "{{$_GET.shift}}",
              "test": "36"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.department}}",
              "test": "2"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "sum(transaction_amount)",
          "type": "text"
        },
        {
          "name": "customer_id",
          "type": "number"
        },
        {
          "name": "customer_first_name",
          "type": "file"
        },
        {
          "name": "customer_last_name",
          "type": "file"
        },
        {
          "name": "servo_shift_shift_id",
          "type": "number"
        },
        {
          "name": "order_id",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>