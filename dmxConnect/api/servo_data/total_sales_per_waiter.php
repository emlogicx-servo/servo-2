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
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "current_shift"
      }
    ],
    "$_SESSION": [
      {
        "type": "text",
        "name": "user_id"
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
            "name": "servo_order_items"
          },
          "joins": [
            {
              "table": "servo_orders",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_orders",
                    "column": "order_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_orders_order_id"
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
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_user.user_id",
                "field": "servo_user.user_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.user_id}}",
                "data": {
                  "table": "servo_user",
                  "column": "user_id",
                  "type": "number"
                },
                "operation": "="
              },
              {
                "id": "servo_orders.servo_shift_shift_id",
                "field": "servo_orders.servo_shift_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.current_shift}}",
                "data": {
                  "table": "servo_orders",
                  "column": "servo_shift_shift_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_order_items\nINNER JOIN servo_orders ON (servo_orders.order_id = servo_order_items.servo_orders_order_id) INNER JOIN servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id)\nWHERE servo_user.user_id = :P1 /* {{$_GET.user_id}} */ AND servo_orders.servo_shift_shift_id = :P2 /* {{$_GET.current_shift}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.user_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.current_shift}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "order_item_id"
        },
        {
          "type": "datetime",
          "name": "order_time_ordered"
        },
        {
          "type": "datetime",
          "name": "order_time_ready"
        },
        {
          "type": "datetime",
          "name": "order_time_delivered"
        },
        {
          "type": "text",
          "name": "order_item_status"
        },
        {
          "type": "number",
          "name": "servo_orders_order_id"
        },
        {
          "type": "number",
          "name": "servo_products_product_id"
        },
        {
          "type": "number",
          "name": "servo_user_user_prepared_id"
        },
        {
          "type": "text",
          "name": "order_item_notes"
        },
        {
          "type": "number",
          "name": "order_item_quantity"
        },
        {
          "type": "number",
          "name": "order_item_price"
        },
        {
          "type": "number",
          "name": "order_item_discount"
        },
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>