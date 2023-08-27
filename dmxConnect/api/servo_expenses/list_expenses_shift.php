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
        "name": "shift"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_expenses_shift",
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
              "column": "expense_type"
            },
            {
              "table": "servo_expenses",
              "column": "expense_department"
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
              "table": "user_received",
              "column": "user_id",
              "alias": "user_received_id"
            },
            {
              "table": "user_received",
              "column": "user_username",
              "alias": "user_received_name"
            },
            {
              "table": "user_paid",
              "column": "user_id",
              "alias": "user_paid_id"
            },
            {
              "table": "user_paid",
              "column": "user_username",
              "alias": "user_paid_name"
            },
            {
              "table": "servo_department",
              "column": "department_id"
            },
            {
              "table": "servo_department",
              "column": "department_name",
              "aggregate": ""
            },
            {
              "table": "servo_expenses",
              "column": "expense_amount",
              "alias": "Total",
              "aggregate": "SUM"
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
              "table": "servo_user",
              "column": "*",
              "alias": "user_received",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "user_received",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_expenses",
                      "column": "expense_user_received"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "alias": "user_paid",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "user_paid",
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
                      "table": "servo_expenses",
                      "column": "expense_payment_method"
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
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_vendors",
                    "column": "vendor_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_expenses",
                      "column": "expense_vendor"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "vendor_id"
            }
          ],
          "query": "SELECT servo_expenses.expense_id, servo_expenses.expense_amount, servo_expenses.expense_date_requested, servo_expenses.expense_date_paid, servo_expenses.expense_user_paid, servo_expenses.expense_user_received, servo_expenses.expense_description, servo_expenses.expense_status, servo_expenses.expense_type, servo_expenses.expense_department, servo_expenses.expense_user_approved, servo_expenses.expense_shift, user_received.user_id AS user_received_id, user_received.user_username AS user_received_name, user_paid.user_id AS user_paid_id, user_paid.user_username AS user_paid_name, servo_department.department_id, servo_department.department_name, SUM(servo_expenses.expense_amount) AS Total, servo_payment_methods.payment_method_id, servo_payment_methods.payment_method_name, servo_vendors.vendor_id, servo_vendors.vendor_name\nFROM servo_expenses\nLEFT JOIN servo_user AS user_received ON user_received.user_id = servo_expenses.expense_user_received LEFT JOIN servo_user AS user_paid ON user_paid.user_id = servo_expenses.expense_user_paid LEFT JOIN servo_department ON servo_department.department_id = servo_expenses.expense_department LEFT JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_expenses.expense_payment_method LEFT JOIN servo_vendors ON servo_vendors.vendor_id = servo_expenses.expense_vendor\nWHERE servo_expenses.expense_shift = :P1 /* {{$_GET.shift}} */ AND servo_expenses.expenses_deleted_status = 'n'\nGROUP BY servo_expenses.expense_id, servo_expenses.expense_amount, servo_expenses.expense_date_requested, servo_expenses.expense_date_paid, servo_expenses.expense_user_paid, servo_expenses.expense_user_received, servo_expenses.expense_description, servo_expenses.expense_status, servo_expenses.expense_type, servo_expenses.expense_department, servo_expenses.expense_user_approved, servo_expenses.expense_shift, user_received.user_id, user_received.user_username, user_paid.user_id, user_paid.user_username, servo_department.department_id, servo_department.department_name, servo_payment_methods.payment_method_id, servo_payment_methods.payment_method_name, servo_vendors.vendor_id, servo_vendors.vendor_name\nORDER BY servo_expenses.expense_date_paid ASC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.shift}}",
              "test": ""
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_expenses.expense_shift",
                "field": "servo_expenses.expense_shift",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.shift}}",
                "data": {
                  "table": "servo_expenses",
                  "column": "expense_shift",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "primary": false,
                    "nullable": true,
                    "name": "expense_shift"
                  }
                },
                "operation": "="
              },
              {
                "id": "servo_expenses.expenses_deleted_status",
                "field": "servo_expenses.expenses_deleted_status",
                "type": "string",
                "operator": "equal",
                "value": "n",
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
          },
          "orders": [
            {
              "table": "servo_expenses",
              "column": "expense_date_paid",
              "direction": "ASC",
              "recid": 1
            }
          ],
          "groupBy": [
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
              "column": "expense_type"
            },
            {
              "table": "servo_expenses",
              "column": "expense_department"
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
              "table": "user_received",
              "column": "user_id"
            },
            {
              "table": "user_received",
              "column": "user_username"
            },
            {
              "table": "user_paid",
              "column": "user_id"
            },
            {
              "table": "user_paid",
              "column": "user_username"
            },
            {
              "table": "servo_department",
              "column": "department_id"
            },
            {
              "table": "servo_department",
              "column": "department_name"
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
          ]
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
          "type": "text",
          "name": "expense_type"
        },
        {
          "type": "number",
          "name": "expense_department"
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
          "type": "number",
          "name": "user_received_id"
        },
        {
          "type": "text",
          "name": "user_received_name"
        },
        {
          "type": "number",
          "name": "user_paid_id"
        },
        {
          "type": "text",
          "name": "user_paid_name"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "number",
          "name": "Total"
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