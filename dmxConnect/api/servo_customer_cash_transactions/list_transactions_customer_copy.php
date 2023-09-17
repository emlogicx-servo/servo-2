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
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_customer_cash_transaction",
              "column": "customer_transaction_id"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "customer_id"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_amount"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_type"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "user_approved_id"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_date"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_payment_method"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_status"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_note"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_order"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_balance"
            },
            {
              "table": "servo_customer_cash_transaction",
              "column": "transaction_amount_tendered"
            },
            {
              "table": "servo_user",
              "column": "user_id"
            },
            {
              "table": "servo_user",
              "column": "user_fname"
            },
            {
              "table": "servo_user",
              "column": "user_lname"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_user",
              "column": "servo_user_departments_department_id"
            },
            {
              "table": "servo_user",
              "column": "user_profile"
            },
            {
              "table": "servo_payment_methods",
              "column": "payment_method_name"
            }
          ],
          "table": {
            "name": "servo_customer_cash_transaction",
            "alias": "servo_customer_cash_transaction"
          },
          "primary": "customer_transaction_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_customer_cash_transaction",
                      "column": "user_approved_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_payment_methods",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_payment_methods",
                    "column": "payment_method_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_customer_cash_transaction",
                      "column": "transaction_payment_method"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "payment_method_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customer_cash_transaction.customer_id",
                "field": "servo_customer_cash_transaction.customer_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer_id}}",
                "data": {
                  "table": "servo_customer_cash_transaction",
                  "column": "customer_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "customer_id",
                    "inTable": "servo_customers",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "customer_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT servo_customer_cash_transaction.customer_transaction_id, servo_customer_cash_transaction.customer_id, servo_customer_cash_transaction.transaction_amount, servo_customer_cash_transaction.transaction_type, servo_customer_cash_transaction.user_approved_id, servo_customer_cash_transaction.transaction_date, servo_customer_cash_transaction.transaction_payment_method, servo_customer_cash_transaction.transaction_status, servo_customer_cash_transaction.transaction_note, servo_customer_cash_transaction.transaction_order, servo_customer_cash_transaction.transaction_balance, servo_customer_cash_transaction.transaction_amount_tendered, servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.servo_user_departments_department_id, servo_user.user_profile, servo_payment_methods.payment_method_name\nFROM servo_customer_cash_transaction AS servo_customer_cash_transaction\nLEFT JOIN servo_user ON servo_user.user_id = servo_customer_cash_transaction.user_approved_id LEFT JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_customer_cash_transaction.transaction_payment_method\nWHERE servo_customer_cash_transaction.customer_id = :P1 /* {{$_GET.customer_id}} */\nORDER BY servo_customer_cash_transaction.customer_transaction_id DESC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_id}}"
            }
          ],
          "orders": [
            {
              "table": "servo_customer_cash_transaction",
              "column": "customer_transaction_id",
              "direction": "DESC",
              "recid": 1
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "customer_transaction_id"
        },
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
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "servo_user_departments_department_id"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "text",
          "name": "payment_method_name"
        }
      ],
      "outputType": "array",
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>