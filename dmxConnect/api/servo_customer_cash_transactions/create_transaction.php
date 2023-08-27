<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_customer_cash_transaction",
              "column": "customer_id",
              "type": "number",
              "value": "{{$_POST.customer_id.default(null)}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_amount",
              "type": "number",
              "value": "{{$_POST.transaction_amount}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_type",
              "type": "text",
              "value": "{{$_POST.transaction_type}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "user_approved_id",
              "type": "number",
              "value": "{{$_POST.user_approved_id}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_date",
              "type": "datetime",
              "value": "{{$_POST.transaction_date}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_payment_method",
              "type": "number",
              "value": "{{$_POST.transaction_payment_method}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_status",
              "type": "text",
              "value": "{{$_POST.transaction_status}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_note",
              "type": "text",
              "value": "{{$_POST.transaction_note}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_order",
              "type": "number",
              "value": "{{$_POST.transaction_order}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_balance",
              "type": "number",
              "value": "{{$_POST.transaction_balance}}"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_amount_tendered",
              "type": "number",
              "value": "{{$_POST.transaction_amount_tendered}}"
            }
          ],
          "table": "servo_customer_cash_transaction",
          "returning": "customer_transaction_id",
          "query": "insert into `servo_customer_cash_transaction` (`customer_id`, `transaction_amount`, `transaction_amount_tendered`, `transaction_balance`, `transaction_date`, `transaction_note`, `transaction_order`, `transaction_payment_method`, `transaction_status`, `transaction_type`, `user_approved_id`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.customer_id.default(null)}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.transaction_amount}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.transaction_type}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.user_approved_id}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.transaction_date}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.transaction_payment_method}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.transaction_status}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.transaction_note}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.transaction_order}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.transaction_balance}}"
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.transaction_amount_tendered}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>