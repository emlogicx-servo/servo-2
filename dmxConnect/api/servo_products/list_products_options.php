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
      "name": "query_list_products",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_products",
            "alias": "servo_products"
          },
          "joins": [
            {
              "table": "servo_product_brands",
              "column": "*",
              "alias": "servo_product_brands",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_product_brands",
                    "column": "product_brand_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_products",
                      "column": "servo_product_brands_product_brand_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_brand_id"
            },
            {
              "table": "servo_product_categories",
              "column": "*",
              "alias": "servo_product_categories",
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
              },
              "primary": "product_categories_id"
            }
          ],
          "query": "SELECT *\nFROM servo_products AS servo_products\nINNER JOIN servo_product_brands AS servo_product_brands ON (servo_product_brands.product_brand_id = servo_products.servo_product_brands_product_brand_id) INNER JOIN servo_product_categories AS servo_product_categories ON (servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id)",
          "params": [],
          "orders": [],
          "primary": "product_id"
        }
      },
      "meta": [
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
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        },
        {
          "type": "number",
          "name": "product_categories_id"
        },
        {
          "type": "text",
          "name": "product_category_name"
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