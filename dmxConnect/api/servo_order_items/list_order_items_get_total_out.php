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
            "name": "servo_order_items"
          },
          "joins": [
            {
              "table": "servo_products",
              "column": "*",
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
                "value": "Ordered",
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
          },
          "query": "SELECT *\nFROM servo_order_items\nINNER JOIN servo_products ON (servo_products.product_id = servo_order_items.servo_products_product_id) INNER JOIN servo_orders ON (servo_orders.order_id = servo_order_items.servo_orders_order_id) INNER JOIN servo_customer_table ON (servo_customer_table.table_id = servo_orders.servo_customer_table_table_id)\nWHERE servo_orders.order_status = 'Ordered'",
          "params": []
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
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
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
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>