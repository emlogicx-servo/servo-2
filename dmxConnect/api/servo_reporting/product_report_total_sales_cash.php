<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "number",
        "name": "user"
      },
      {
        "type": "text",
        "name": "datefrom"
      },
      {
        "type": "text",
        "name": "dateto"
      },
      {
        "type": "text",
        "name": "service"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_product_report_total_sales",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select SUM(transaction_amount) as TotalSales, sum(transaction_balance) as TotalBalances from servo_customer_cash_transaction\n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nwhere transaction_type = 'Settlement' and servo_user_user_id LIKE ? and order_time >= ? and order_time <= ? and servo_service_service_id LIKE ?",
          "params": [
            {
              "name": "?",
              "value": "{{$_GET.user}}",
              "test": "%"
            },
            {
              "name": "?",
              "value": "{{$_GET.datefrom}}",
              "test": "2022-05-05"
            },
            {
              "name": "?",
              "value": "{{$_GET.dateto}}",
              "test": "2022-11-11"
            },
            {
              "name": "?",
              "value": "{{$_GET.service}}",
              "test": "%"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "TotalSales",
          "type": "text"
        },
        {
          "name": "TotalBalances",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>