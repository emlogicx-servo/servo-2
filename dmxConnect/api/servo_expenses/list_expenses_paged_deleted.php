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
      "name": "list_expenses_paged_deleted",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_expenses"
          },
          "primary": "expense_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
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
                      "column": "expense_user_paid"
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
                      "column": "expense_user_paid"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT *\nFROM servo_expenses\nLEFT JOIN servo_user ON user_received.user_id = servo_expenses.expense_user_paid LEFT JOIN servo_user AS user_received ON user_received.user_id = servo_expenses.expense_user_paid\nWHERE servo_expenses.expenses_deleted_status = 'y'",
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
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
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
              "name": "expense_payment_method"
            },
            {
              "type": "number",
              "name": "expense_vendor"
            },
            {
              "type": "text",
              "name": "expenses_deleted_status"
            }
          ]
        }
      ],
      "type": "dbconnector_paged_select",
      "outputType": "object"
    }
  }
}
JSON
);
?>