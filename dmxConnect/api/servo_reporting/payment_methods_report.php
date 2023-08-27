<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
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
        "name": "user"
      },
      {
        "type": "text",
        "name": "service"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "payments_report",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select transaction_amount as Payment, payment_method_name as Method, transaction_type as Type from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\nleft join servo_services on (service_id = servo_service_service_id)\n\nwhere order_time >= ? and order_time <= ? and servo_user_user_id like ? and servo_service_service_id like ?\n",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2022-05-11 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2022-11-11 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.service}}",
                "test": "%"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "Payment",
            "type": "number"
          },
          {
            "name": "Method",
            "type": "text"
          },
          {
            "name": "Type",
            "type": "file"
          }
        ],
        "output": true,
        "disabled": true
      },
      {
        "name": "payment_methods_report",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select SUM(transaction_amount) as TotalPayments, payment_method_name as Method from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\nleft join servo_services on (service_id = servo_service_service_id)\n\nwhere transaction_type = 'Settlement' and order_time >= ? and order_time <= ? and servo_user_user_id like ? and servo_service_service_id like ?\n\ngroup by servo_payment_methods.payment_method_name",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2022-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2022-11-11 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
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
            "name": "TotalPayments",
            "type": "text"
          },
          {
            "name": "Method",
            "type": "text"
          }
        ]
      }
    ]
  }
}
JSON
);
?>