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
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_orders"
          },
          "joins": [
            {
              "table": "servo_customer_table",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customer_table",
                    "column": "table_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_customer_table_table_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_user",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_user_user_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_customers",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customers",
                    "column": "customer_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "order_customer"
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT *\nFROM servo_orders\nINNER JOIN servo_customer_table ON (servo_customer_table.table_id = servo_orders.servo_customer_table_table_id) INNER JOIN servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id) INNER JOIN servo_customers ON (servo_customers.customer_id = servo_orders.order_customer)\nWHERE servo_orders.order_status = 'Credit'\nORDER BY servo_orders.order_id DESC",
          "params": [],
          "orders": [
            {
              "table": "servo_orders",
              "column": "order_id",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_orders.order_status",
                "field": "servo_orders.order_status",
                "type": "string",
                "operator": "equal",
                "value": "Credit",
                "data": {
                  "table": "servo_orders",
                  "column": "order_status",
                  "type": "text"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "meta": [
        {
          "type": "number",
          "name": "order_id"
        },
        {
          "type": "datetime",
          "name": "order_time"
        },
        {
          "type": "number",
          "name": "order_customer"
        },
        {
          "type": "number",
          "name": "order_discount"
        },
        {
          "type": "text",
          "name": "order_status"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        },
        {
          "type": "number",
          "name": "servo_customer_table_table_id"
        },
        {
          "type": "text",
          "name": "order_notes"
        },
        {
          "type": "number",
          "name": "servo_shift_shift_id"
        },
        {
          "type": "number",
          "name": "order_amount_tendered"
        },
        {
          "type": "number",
          "name": "order_balance"
        },
        {
          "type": "text",
          "name": "order_payment_method"
        },
        {
          "type": "number",
          "name": "servo_users_cashier_id"
        },
        {
          "type": "number",
          "name": "servo_payment_methods_payment_method"
        },
        {
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
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
          "type": "text",
          "name": "password"
        },
        {
          "type": "number",
          "name": "servo_user_profile_user_profile_id"
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
          "type": "number",
          "name": "customer_id"
        },
        {
          "type": "text",
          "name": "customer_first_name"
        },
        {
          "type": "text",
          "name": "customer_last_name"
        },
        {
          "type": "number",
          "name": "customer_phone_number"
        }
      ],
      "outputType": "array",
      "output": true
    }
  }
}
JSON
);
?>