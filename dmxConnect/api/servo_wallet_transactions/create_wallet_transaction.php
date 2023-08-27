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
        "name": "transaction_user_initiated_id"
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
        "name": "transaction_originating_wallet"
      },
      {
        "type": "number",
        "name": "transaction_destination_wallet"
      },
      {
        "type": "text",
        "name": "delete_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_wallet_transaction",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_amount",
              "type": "number",
              "value": "{{$_POST.transaction_amount}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_type",
              "type": "text",
              "value": "{{$_POST.transaction_type}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_user_initiated_id",
              "type": "number",
              "value": "{{$_POST.transaction_user_initiated_id}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_date",
              "type": "datetime",
              "value": "{{$_POST.transaction_date}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_payment_method",
              "type": "number",
              "value": "{{$_POST.transaction_payment_method}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_status",
              "type": "text",
              "value": "{{$_POST.transaction_status}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_note",
              "type": "text",
              "value": "{{$_POST.transaction_note}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_originating_wallet",
              "type": "number",
              "value": "{{$_POST.transaction_originating_wallet}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_destination_wallet",
              "type": "number",
              "value": "{{$_POST.transaction_destination_wallet.default(null)}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "delete_status",
              "type": "text",
              "value": "active"
            }
          ],
          "table": "servo_wallet_transactions",
          "returning": "transaction_id",
          "query": "INSERT INTO servo_wallet_transactions\n(transaction_amount, transaction_type, transaction_user_initiated_id, transaction_date, transaction_payment_method, transaction_status, transaction_note, transaction_originating_wallet, transaction_destination_wallet, delete_status) VALUES (:P1 /* {{$_POST.transaction_amount}} */, :P2 /* {{$_POST.transaction_type}} */, :P3 /* {{$_POST.transaction_user_initiated_id}} */, :P4 /* {{$_POST.transaction_date}} */, :P5 /* {{$_POST.transaction_payment_method}} */, :P6 /* {{$_POST.transaction_status}} */, :P7 /* {{$_POST.transaction_note}} */, :P8 /* {{$_POST.transaction_originating_wallet}} */, :P9 /* {{$_POST.transaction_destination_wallet.default(null)}} */, 'active')",
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
              "value": "{{$_POST.transaction_user_initiated_id}}",
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
              "value": "{{$_POST.transaction_originating_wallet}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.transaction_destination_wallet.default(null)}}",
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