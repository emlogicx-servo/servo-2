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
      "name": "query_list_all_order_products",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_products",
              "column": "product_name",
              "aggregate": ""
            },
            {
              "table": "servo_product_categories",
              "column": "product_category_name"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_quantity",
              "aggregate": ""
            },
            {
              "table": "servo_order_items",
              "column": "order_item_price"
            },
            {
              "table": "servo_orders",
              "column": "order_time"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_products",
              "column": "product_id",
              "aggregate": ""
            }
          ],
          "table": {
            "name": "servo_products"
          },
          "joins": [
            {
              "table": "servo_product_categories",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_product_categories",
                    "column": "product_categories_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_products",
                      "column": "servo_product_category_product_category_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_order_items",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_order_items",
                    "column": "servo_products_product_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_products",
                      "column": "product_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
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
          "query": "SELECT servo_products.product_name, servo_product_categories.product_category_name, servo_order_items.order_item_quantity, servo_order_items.order_item_price, servo_orders.order_time, servo_user.user_username, servo_products.product_id\nFROM servo_products\nINNER JOIN servo_product_categories ON (servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id) INNER JOIN servo_order_items ON (servo_order_items.servo_products_product_id = servo_products.product_id) INNER JOIN servo_orders ON (servo_orders.order_id = servo_order_items.servo_orders_order_id) INNER JOIN servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id)",
          "params": [],
          "orders": []
        }
      },
      "meta": [
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "text",
          "name": "product_category_name"
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
          "type": "datetime",
          "name": "order_time"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "product_id"
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