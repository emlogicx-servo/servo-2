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
    "steps": [
      {
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
              }
            ],
            "query": "SELECT *\nFROM servo_order_items\nINNER JOIN servo_products ON (servo_products.product_id = servo_order_items.servo_products_product_id)",
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
          }
        ],
        "outputType": "array"
      },
      {
        "name": "order_total",
        "module": "collections",
        "action": "addColumns",
        "options": {
          "collection": "{{query}}",
          "add": {
            "Total": "{{query[0].product_price}}",
            "": ""
          }
        },
        "meta": [
          {
            "name": "order_item_id",
            "type": "number"
          },
          {
            "name": "order_time_ordered",
            "type": "datetime"
          },
          {
            "name": "order_time_ready",
            "type": "datetime"
          },
          {
            "name": "order_time_delivered",
            "type": "datetime"
          },
          {
            "name": "order_item_status",
            "type": "text"
          },
          {
            "name": "servo_orders_order_id",
            "type": "number"
          },
          {
            "name": "servo_products_product_id",
            "type": "number"
          },
          {
            "name": "servo_user_user_prepared_id",
            "type": "number"
          },
          {
            "name": "order_item_notes",
            "type": "text"
          },
          {
            "name": "order_item_quantity",
            "type": "number"
          },
          {
            "name": "order_item_price",
            "type": "number"
          },
          {
            "name": "order_item_discount",
            "type": "number"
          },
          {
            "name": "product_id",
            "type": "number"
          },
          {
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "product_picture",
            "type": "file"
          },
          {
            "name": "servo_product_brands_product_brand_id",
            "type": "number"
          },
          {
            "name": "product_description",
            "type": "text"
          },
          {
            "name": "servo_product_category_product_category_id",
            "type": "number"
          },
          {
            "name": "product_price",
            "type": "number"
          },
          {
            "name": "product_discount",
            "type": "number"
          },
          {
            "name": "Total",
            "type": "text"
          },
          {
            "name": "",
            "type": "text"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>