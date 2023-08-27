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
        "name": "current_shift"
      },
      {
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "text",
        "name": "sales_point"
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
            "name": "servo_order_items",
            "alias": "servo_order_items"
          },
          "joins": [
            {
              "table": "servo_orders",
              "column": "*",
              "alias": "servo_orders",
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
              },
              "primary": "order_id"
            },
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
                      "column": "servo_user_user_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_services",
              "column": "*",
              "alias": "servo_services",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_services",
                    "column": "service_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_service_service_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "service_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_orders.servo_shift_shift_id",
                "field": "servo_orders.servo_shift_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.current_shift}}",
                "data": {
                  "table": "servo_orders",
                  "column": "servo_shift_shift_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "shift_id",
                    "inTable": "servo_shifts",
                    "onUpdate": "NO ACTION",
                    "onDelete": "NO ACTION",
                    "name": "servo_shift_shift_id"
                  }
                },
                "operation": "="
              },
              {
                "id": "servo_orders.order_status",
                "field": "servo_orders.order_status",
                "type": "string",
                "operator": "equal",
                "value": "{{$_GET.order_status}}",
                "data": {
                  "table": "servo_orders",
                  "column": "order_status",
                  "type": "text",
                  "columnObj": {
                    "type": "enum",
                    "maxLength": 10,
                    "primary": false,
                    "nullable": true,
                    "name": "order_status"
                  }
                },
                "operation": "="
              },
              {
                "id": "servo_services.servo_service_sales_point",
                "field": "servo_services.servo_service_sales_point",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.sales_point}}",
                "data": {
                  "table": "servo_services",
                  "column": "servo_service_sales_point",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "sales_point_id",
                    "inTable": "servo_sales_point",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "servo_service_sales_point"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_order_items AS servo_order_items\nINNER JOIN servo_orders AS servo_orders ON (servo_orders.order_id = servo_order_items.servo_orders_order_id) INNER JOIN servo_user AS servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id) INNER JOIN servo_services AS servo_services ON (servo_services.service_id = servo_orders.servo_service_service_id)\nWHERE servo_orders.servo_shift_shift_id = :P1 /* {{$_GET.current_shift}} */ AND servo_orders.order_status = :P2 /* {{$_GET.order_status}} */ AND servo_services.servo_service_sales_point = :P3 /* {{$_GET.sales_point}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.current_shift}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.order_status}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.sales_point}}"
            }
          ],
          "primary": "order_item_id"
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
          "type": "datetime",
          "name": "order_time_processing"
        },
        {
          "type": "text",
          "name": "order_item_type"
        },
        {
          "type": "number",
          "name": "servo_users_user_ordered"
        },
        {
          "type": "text",
          "name": "order_item_group_type"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
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
          "type": "number",
          "name": "servo_users_cashier_id"
        },
        {
          "type": "number",
          "name": "servo_payment_methods_payment_method"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
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
          "name": "servo_user_departments_department_id"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "number",
          "name": "service_id"
        },
        {
          "type": "text",
          "name": "service_name"
        },
        {
          "type": "number",
          "name": "servo_service_sales_point"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>