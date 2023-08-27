<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "order_id"
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
                      "table": "servo_order_items",
                      "column": "servo_users_user_ordered",
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
                "id": "servo_order_items.servo_orders_order_id",
                "field": "servo_order_items.servo_orders_order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.order_id}}",
                "data": {
                  "table": "servo_order_items",
                  "column": "servo_orders_order_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_order_items AS servo_order_items\nINNER JOIN servo_products AS servo_products ON (servo_products.product_id = servo_order_items.servo_products_product_id) INNER JOIN servo_user AS servo_user ON (servo_user.user_id = servo_order_items.servo_users_user_ordered)\nWHERE servo_order_items.servo_orders_order_id = :P1 /* {{$_GET.order_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.order_id}}"
            }
          ],
          "orders": [],
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
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "text",
          "name": "product_picture"
        },
        {
          "type": "number",
          "name": "servo_product_brands_product_brand_id"
        },
        {
          "type": "text",
          "name": "product_description"
        },
        {
          "type": "number",
          "name": "servo_product_category_product_category_id"
        },
        {
          "type": "number",
          "name": "product_standard_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "text",
          "name": "product_type"
        },
        {
          "type": "number",
          "name": "product_stock_value"
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