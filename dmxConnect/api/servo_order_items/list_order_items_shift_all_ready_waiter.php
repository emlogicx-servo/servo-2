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
        "name": "order_item_status"
      },
      {
        "type": "text",
        "name": "shift_id"
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
              "table": "servo_order_items",
              "column": "order_time_ordered"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_ready"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_status"
            },
            {
              "table": "servo_order_items",
              "column": "servo_orders_order_id"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_quantity"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_notes"
            },
            {
              "table": "servo_department",
              "column": "department_name"
            },
            {
              "table": "servo_customer_table",
              "column": "table_name"
            },
            {
              "table": "servo_customer_table",
              "column": "table_id"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_orders",
              "column": "order_id"
            },
            {
              "table": "servo_orders",
              "column": "order_customer"
            },
            {
              "table": "servo_orders",
              "column": "servo_user_user_id"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_group_type"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_type"
            }
          ],
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
              "table": "servo_products",
              "column": "*",
              "alias": "servo_products",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_products_product_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_id"
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
              "table": "servo_customer_table",
              "column": "*",
              "alias": "servo_customer_table",
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
              },
              "primary": "table_id"
            },
            {
              "table": "servo_department",
              "column": "*",
              "alias": "servo_department",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_department",
                    "column": "department_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_departments_department_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "department_id"
            }
          ],
          "query": "SELECT servo_order_items.order_time_ordered, servo_order_items.order_time_ready, servo_order_items.order_item_status, servo_order_items.servo_orders_order_id, servo_order_items.order_item_quantity, servo_order_items.order_item_notes, servo_department.department_name, servo_customer_table.table_name, servo_customer_table.table_id, servo_user.user_username, servo_products.product_name, servo_orders.order_id, servo_orders.order_customer, servo_orders.servo_user_user_id, servo_order_items.order_item_group_type, servo_order_items.order_item_type\nFROM servo_order_items AS servo_order_items\nINNER JOIN servo_orders AS servo_orders ON (servo_orders.order_id = servo_order_items.servo_orders_order_id) INNER JOIN servo_products AS servo_products ON (servo_products.product_id = servo_order_items.servo_products_product_id) INNER JOIN servo_user AS servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id) INNER JOIN servo_customer_table AS servo_customer_table ON (servo_customer_table.table_id = servo_orders.servo_customer_table_table_id) INNER JOIN servo_department AS servo_department ON (servo_department.department_id = servo_order_items.servo_departments_department_id)\nWHERE servo_order_items.order_item_status = :P1 /* {{$_GET.order_item_status}} */ AND servo_orders.servo_shift_shift_id = :P2 /* {{$_GET.shift_id}} */ AND servo_orders.servo_user_user_id = :P3 /* {{$_GET.user_id}} */\nORDER BY servo_order_items.order_time_ready ASC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.order_item_status}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.shift_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.user_id}}"
            }
          ],
          "orders": [
            {
              "table": "servo_order_items",
              "column": "order_time_ready",
              "direction": "ASC"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_order_items.order_item_status",
                "field": "servo_order_items.order_item_status",
                "type": "string",
                "operator": "equal",
                "value": "{{$_GET.order_item_status}}",
                "data": {
                  "table": "servo_order_items",
                  "column": "order_item_status",
                  "type": "text"
                },
                "operation": "="
              },
              {
                "id": "servo_orders.servo_shift_shift_id",
                "field": "servo_orders.servo_shift_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.shift_id}}",
                "data": {
                  "table": "servo_orders",
                  "column": "servo_shift_shift_id",
                  "type": "number"
                },
                "operation": "="
              },
              {
                "id": "servo_orders.servo_user_user_id",
                "field": "servo_orders.servo_user_user_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.user_id}}",
                "data": {
                  "table": "servo_orders",
                  "column": "servo_user_user_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "primary": "order_item_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "datetime",
          "name": "order_time_ordered"
        },
        {
          "type": "datetime",
          "name": "order_time_ready"
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
          "name": "order_item_quantity"
        },
        {
          "type": "text",
          "name": "order_item_notes"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "text",
          "name": "table_name"
        },
        {
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "number",
          "name": "order_id"
        },
        {
          "type": "number",
          "name": "order_customer"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        },
        {
          "type": "text",
          "name": "order_item_group_type"
        },
        {
          "type": "text",
          "name": "order_item_type"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>