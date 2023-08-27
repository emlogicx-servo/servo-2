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
      "name": "query_list_adjustment_orders",
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
            }
          ],
          "query": "SELECT *\nFROM servo_orders\nINNER JOIN servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id)\nWHERE servo_orders.order_status = 'Adjustment'\nORDER BY servo_orders.order_time DESC",
          "params": [],
          "orders": [
            {
              "table": "servo_orders",
              "column": "order_time",
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
                "value": "Adjustment",
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
          "name": "servo_users_cashier_id"
        },
        {
          "type": "number",
          "name": "servo_payment_methods_payment_method"
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>