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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_expenses",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_expenses",
              "column": "expense_id"
            },
            {
              "table": "servo_expenses",
              "column": "expense_amount"
            },
            {
              "table": "servo_expenses",
              "column": "expense_date_requested"
            },
            {
              "table": "servo_expenses",
              "column": "expense_date_paid"
            },
            {
              "table": "servo_expenses",
              "column": "expense_user_paid"
            },
            {
              "table": "servo_expenses",
              "column": "expense_user_received"
            },
            {
              "table": "servo_expenses",
              "column": "expense_description"
            },
            {
              "table": "servo_expenses",
              "column": "expense_status"
            },
            {
              "table": "servo_expenses",
              "column": "expense_department"
            },
            {
              "table": "servo_expenses",
              "column": "expense_type"
            },
            {
              "table": "servo_expenses",
              "column": "expense_user_approved"
            },
            {
              "table": "servo_expenses",
              "column": "expense_shift"
            },
            {
              "table": "servo_department",
              "column": "department_name"
            },
            {
              "table": "servo_user",
              "column": "user_username"
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
              "table": "servo_payment_methods",
              "column": "payment_method_id"
            },
            {
              "table": "servo_payment_methods",
              "column": "payment_method_name"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_id"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_name"
            }
          ],
          "table": {
            "name": "servo_expenses"
          },
          "primary": "expense_id",
          "joins": [
            {
              "table": "servo_department",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_department",
                    "column": "department_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_expenses",
                      "column": "expense_department"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "department_id"
            },
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
                      "table": "servo_expenses",
                      "column": "expense_user_paid"
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
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_payment_methods",
                    "column": "payment_method_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_expenses",
                      "column": "expense_payment_method",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "payment_method_id"
            },
            {
              "table": "servo_vendors",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_vendors",
                    "column": "vendor_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_expenses",
                      "column": "expense_vendor",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "vendor_id"
            }
          ],
          "query": "SELECT servo_expenses.expense_id, servo_expenses.expense_amount, servo_expenses.expense_date_requested, servo_expenses.expense_date_paid, servo_expenses.expense_user_paid, servo_expenses.expense_user_received, servo_expenses.expense_description, servo_expenses.expense_status, servo_expenses.expense_department, servo_expenses.expense_type, servo_expenses.expense_user_approved, servo_expenses.expense_shift, servo_department.department_name, servo_user.user_username, servo_user.user_fname, servo_user.user_lname, servo_payment_methods.payment_method_id, servo_payment_methods.payment_method_name, servo_vendors.vendor_id, servo_vendors.vendor_name\nFROM servo_expenses\nLEFT JOIN servo_department ON servo_department.department_id = servo_expenses.expense_department LEFT JOIN servo_user ON servo_user.user_id = servo_expenses.expense_user_paid INNER JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_expenses.expense_payment_method INNER JOIN servo_vendors ON servo_vendors.vendor_id = servo_expenses.expense_vendor\nWHERE servo_expenses.expenses_deleted_status = 'y'",
          "params": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_expenses.expenses_deleted_status",
                "field": "servo_expenses.expenses_deleted_status",
                "type": "string",
                "operator": "equal",
                "value": "y",
                "data": {
                  "table": "servo_expenses",
                  "column": "expenses_deleted_status",
                  "type": "text",
                  "columnObj": {
                    "type": "enum",
                    "enumValues": [
                      "y",
                      "n"
                    ],
                    "default": "'n'",
                    "maxLength": 1,
                    "primary": false,
                    "nullable": true,
                    "name": "expenses_deleted_status"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "expense_id"
        },
        {
          "type": "number",
          "name": "expense_amount"
        },
        {
          "type": "datetime",
          "name": "expense_date_requested"
        },
        {
          "type": "datetime",
          "name": "expense_date_paid"
        },
        {
          "type": "number",
          "name": "expense_user_paid"
        },
        {
          "type": "number",
          "name": "expense_user_received"
        },
        {
          "type": "text",
          "name": "expense_description"
        },
        {
          "type": "text",
          "name": "expense_status"
        },
        {
          "type": "number",
          "name": "expense_department"
        },
        {
          "type": "text",
          "name": "expense_type"
        },
        {
          "type": "number",
          "name": "expense_user_approved"
        },
        {
          "type": "number",
          "name": "expense_shift"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "text",
          "name": "user_username"
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
          "type": "number",
          "name": "payment_method_id"
        },
        {
          "type": "text",
          "name": "payment_method_name"
        },
        {
          "type": "number",
          "name": "vendor_id"
        },
        {
          "type": "text",
          "name": "vendor_name"
        }
      ],
      "type": "dbconnector_select",
      "outputType": "array"
    }
  }
}
JSON
);
?>