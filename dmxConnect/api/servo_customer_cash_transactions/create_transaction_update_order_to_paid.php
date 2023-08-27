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
      },
      {
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "number",
        "name": "servo_payment_methods_payment_method"
      },
      {
        "type": "number",
        "name": "order_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "create_transaction_cashier_update_order_to_paid",
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
                "value": "{{$_POST.customer_id}}"
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
            "query": "INSERT INTO servo_customer_cash_transaction\n(customer_id, transaction_amount, transaction_type, user_approved_id, transaction_date, transaction_payment_method, transaction_status, transaction_note, transaction_order, transaction_balance, transaction_amount_tendered) VALUES (:P1 /* {{$_POST.customer_id}} */, :P2 /* {{$_POST.transaction_amount}} */, :P3 /* {{$_POST.transaction_type}} */, :P4 /* {{$_POST.user_approved_id}} */, :P5 /* {{$_POST.transaction_date}} */, :P6 /* {{$_POST.transaction_payment_method}} */, :P7 /* {{$_POST.transaction_status}} */, :P8 /* {{$_POST.transaction_note}} */, :P9 /* {{$_POST.transaction_order}} */, :P10 /* {{$_POST.transaction_balance}} */, :P11 /* {{$_POST.transaction_amount_tendered}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.customer_id}}"
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
      },
      {
        "name": "update_order_to_paid",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "servo_orders",
                "column": "order_status",
                "type": "text",
                "value": "Paid"
              },
              {
                "table": "servo_orders",
                "column": "servo_payment_methods_payment_method",
                "type": "number",
                "value": "{{$_POST.transaction_payment_method}}"
              }
            ],
            "table": "servo_orders",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "order_id",
                  "field": "order_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.transaction_order}}",
                  "data": {
                    "column": "order_id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "order_id",
            "query": "UPDATE servo_orders\nSET order_status = 'Paid', servo_payment_methods_payment_method = :P1 /* {{$_POST.transaction_payment_method}} */\nWHERE order_id = :P2 /* {{$_POST.transaction_order}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.transaction_payment_method}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.transaction_order}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>