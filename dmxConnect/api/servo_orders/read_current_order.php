<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "current_order_id"
      },
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
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_orders",
              "column": "order_id"
            },
            {
              "table": "servo_orders",
              "column": "order_time"
            },
            {
              "table": "servo_orders",
              "column": "order_customer"
            },
            {
              "table": "servo_orders",
              "column": "order_discount"
            },
            {
              "table": "servo_orders",
              "column": "order_status"
            },
            {
              "table": "servo_orders",
              "column": "servo_user_user_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_customer_table_table_id"
            },
            {
              "table": "servo_orders",
              "column": "order_notes"
            },
            {
              "table": "servo_orders",
              "column": "servo_shift_shift_id"
            },
            {
              "table": "servo_orders",
              "column": "order_amount_tendered"
            },
            {
              "table": "servo_orders",
              "column": "order_balance"
            },
            {
              "table": "servo_orders",
              "column": "servo_users_cashier_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_payment_methods_payment_method"
            },
            {
              "table": "servo_orders",
              "column": "servo_departments_department_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_service_service_id"
            },
            {
              "table": "servo_orders",
              "column": "coverage_percentage"
            },
            {
              "table": "servo_orders",
              "column": "coverage_partner"
            },
            {
              "table": "servo_orders",
              "column": "coverage_payment_status"
            },
            {
              "table": "servo_orders",
              "column": "order_time_paid"
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
              "table": "servo_orders",
              "column": "order_extra_info"
            }
          ],
          "table": {
            "name": "servo_orders",
            "alias": "servo_orders"
          },
          "primary": "order_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "alias": "servo_user",
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
                      "column": "servo_users_cashier_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_orders.order_id",
                "field": "servo_orders.order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.current_order_id}}",
                "data": {
                  "table": "servo_orders",
                  "column": "order_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "order_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT servo_orders.order_id, servo_orders.order_time, servo_orders.order_customer, servo_orders.order_discount, servo_orders.order_status, servo_orders.servo_user_user_id, servo_orders.servo_customer_table_table_id, servo_orders.order_notes, servo_orders.servo_shift_shift_id, servo_orders.order_amount_tendered, servo_orders.order_balance, servo_orders.servo_users_cashier_id, servo_orders.servo_payment_methods_payment_method, servo_orders.servo_departments_department_id, servo_orders.servo_service_service_id, servo_orders.coverage_percentage, servo_orders.coverage_partner, servo_orders.coverage_payment_status, servo_orders.order_time_paid, servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.servo_user_departments_department_id, servo_user.user_profile, servo_orders.order_extra_info\nFROM servo_orders AS servo_orders\nINNER JOIN servo_user AS servo_user ON servo_user.user_id = servo_orders.servo_users_cashier_id\nWHERE servo_orders.order_id = :P1 /* {{$_GET.current_order_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.current_order_id}}"
            }
          ]
        },
        "connection": "servodb"
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
          "type": "number",
          "name": "servo_users_cashier_id"
        },
        {
          "type": "number",
          "name": "servo_payment_methods_payment_method"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "number",
          "name": "coverage_percentage"
        },
        {
          "type": "number",
          "name": "coverage_partner"
        },
        {
          "type": "text",
          "name": "coverage_payment_status"
        },
        {
          "type": "datetime",
          "name": "order_time_paid"
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
          "name": "order_extra_info"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>