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
      "name": "query_list_all_orders",
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
              "table": "servo_shifts",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_shifts",
                    "column": "servo_branches_branch_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_customer_table",
                      "column": "servo_branches_branch_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT *\nFROM servo_orders\nINNER JOIN servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id) INNER JOIN servo_customer_table ON (servo_customer_table.table_id = servo_orders.servo_customer_table_table_id) INNER JOIN servo_shifts ON (servo_shifts.servo_branches_branch_id = servo_customer_table.servo_branches_branch_id)\nORDER BY servo_orders.order_time DESC",
          "params": [],
          "orders": [
            {
              "table": "servo_orders",
              "column": "order_time",
              "direction": "DESC"
            }
          ]
        }
      },
      "output": true,
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
          "name": "shift_id"
        },
        {
          "type": "datetime",
          "name": "shift_start"
        },
        {
          "type": "datetime",
          "name": "shift_stop"
        },
        {
          "type": "text",
          "name": "shift_status"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>