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
        "name": "productfilter"
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
              "type": "LEFT",
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
              "type": "LEFT",
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
            },
            {
              "table": "servo_product_sub_category",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_product_sub_category",
                    "column": "product_sub_category_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_products",
                      "column": "product_sub_category_sub_category_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_sub_category_id"
            }
          ],
          "query": "SELECT *\nFROM servo_products AS servo_products\nLEFT JOIN servo_product_brands AS servo_product_brands ON (servo_product_brands.product_brand_id = servo_products.servo_product_brands_product_brand_id) LEFT JOIN servo_product_categories AS servo_product_categories ON (servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id) LEFT JOIN servo_product_sub_category ON (servo_product_sub_category.product_sub_category_id = servo_products.product_sub_category_sub_category_id)\nWHERE servo_products.product_name LIKE :P1 /* {{$_GET.productfilter}} */",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.productfilter}}"
            }
          ],
          "orders": [],
          "primary": "product_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_products.product_name",
                "field": "servo_products.product_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.productfilter}}",
                "data": {
                  "table": "servo_products",
                  "column": "product_name",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 45,
                    "primary": false,
                    "nullable": false,
                    "name": "product_name"
                  }
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          }
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
          "name": "product_min_stock"
        },
        {
          "type": "datetime",
          "name": "product_expiration_date"
        },
        {
          "type": "number",
          "name": "product_sub_category_sub_category_id"
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
        },
        {
          "type": "number",
          "name": "product_sub_category_id"
        },
        {
          "type": "number",
          "name": "product_sub_category_category_id"
        },
        {
          "type": "text",
          "name": "product_sub_category_name"
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