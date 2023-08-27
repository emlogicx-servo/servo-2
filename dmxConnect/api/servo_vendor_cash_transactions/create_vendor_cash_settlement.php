<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
      },
      {
        "type": "number",
        "name": "transaction_vendor_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "crate_vendor_cash_settlement",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_amount",
              "type": "number",
              "value": "{{$_POST.transaction_amount}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_type",
              "type": "text",
              "value": "{{$_POST.transaction_type}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "user_approved_id",
              "type": "number",
              "value": "{{$_POST.user_approved_id}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_date",
              "type": "datetime",
              "value": "{{$_POST.transaction_date}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_payment_method",
              "type": "number",
              "value": "{{$_POST.transaction_payment_method}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_status",
              "type": "text",
              "value": "{{$_POST.transaction_status}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_note",
              "type": "text",
              "value": "{{$_POST.transaction_note}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_order",
              "type": "number",
              "value": "{{$_POST.transaction_order}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_balance",
              "type": "number",
              "value": "{{$_POST.transaction_balance}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_amount_tendered",
              "type": "number",
              "value": "{{$_POST.transaction_amount_tendered}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_vendor_id",
              "type": "number",
              "value": "{{$_POST.transaction_vendor_id}}"
            }
          ],
          "table": "servo_vendor_cash_transaction",
          "returning": "vendor_transaction_id",
          "query": "insert into `servo_vendor_cash_transaction` (`transaction_amount`, `transaction_amount_tendered`, `transaction_balance`, `transaction_date`, `transaction_note`, `transaction_order`, `transaction_payment_method`, `transaction_status`, `transaction_type`, `transaction_vendor_id`, `user_approved_id`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.transaction_amount}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.transaction_type}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.user_approved_id}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.transaction_date}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.transaction_payment_method}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.transaction_status}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.transaction_note}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.transaction_order}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.transaction_balance}}",
              "test": ""
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.transaction_amount_tendered}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.transaction_vendor_id}}",
              "test": ""
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