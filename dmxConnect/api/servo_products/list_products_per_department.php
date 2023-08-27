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
        "name": "department_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
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
              },
              {
                "table": "servo_product_price",
                "column": "*",
                "alias": "servo_product_price",
                "type": "INNER",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_product_price",
                      "column": "product_price_product_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_products",
                        "column": "product_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "product_price_id"
              }
            ],
            "query": "SELECT *\nFROM servo_products AS servo_products\nINNER JOIN servo_product_brands AS servo_product_brands ON (servo_product_brands.product_brand_id = servo_products.servo_product_brands_product_brand_id) INNER JOIN servo_product_categories AS servo_product_categories ON (servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id) INNER JOIN servo_product_price AS servo_product_price ON (servo_product_price.product_price_product_id = servo_products.product_id)\nWHERE servo_products.product_name LIKE :P1 /* {{$_GET.search}} */ AND servo_product_price.product_price_department_id = :P2 /* {{$_GET.department_id}} */ AND servo_products.product_type = 'Store'",
            "params": [
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.search}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.department_id}}"
              }
            ],
            "orders": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_products.product_name",
                  "field": "servo_products.product_name",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.search}}",
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
                },
                {
                  "id": "servo_product_price.product_price_department_id",
                  "field": "servo_product_price.product_price_department_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.department_id}}",
                  "data": {
                    "table": "servo_product_price",
                    "column": "product_price_department_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": false,
                      "references": "department_id",
                      "inTable": "servo_department",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "product_price_department_id"
                    }
                  },
                  "operation": "="
                },
                {
                  "id": "servo_products.product_type",
                  "field": "servo_products.product_type",
                  "type": "string",
                  "operator": "equal",
                  "value": "Store",
                  "data": {
                    "table": "servo_products",
                    "column": "product_type",
                    "type": "text",
                    "columnObj": {
                      "type": "text",
                      "maxLength": 65535,
                      "primary": false,
                      "nullable": true,
                      "name": "product_type"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
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
          },
          {
            "type": "number",
            "name": "product_price_id"
          },
          {
            "type": "number",
            "name": "product_price"
          },
          {
            "type": "datetime",
            "name": "product_price_date"
          },
          {
            "type": "number",
            "name": "product_price_product_id"
          },
          {
            "type": "number",
            "name": "product_price_department_id"
          },
          {
            "type": "text",
            "name": "product_department"
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "repeat_product_options",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query_list_products}}",
          "outputFields": [
            "servo_product_category_product_category_id"
          ],
          "exec": {
            "steps": {
              "name": "query_list_product_category_options",
              "module": "dbconnector",
              "action": "select",
              "options": {
                "sql": {
                  "type": "SELECT",
                  "columns": [],
                  "table": {
                    "name": "servo_product_category_options",
                    "alias": "servo_product_category_options"
                  },
                  "primary": "category_option_id",
                  "joins": [],
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "servo_product_category_options.category_option_category_id",
                        "field": "servo_product_category_options.category_option_category_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{servo_product_category_product_category_id}}",
                        "data": {
                          "table": "servo_product_category_options",
                          "column": "category_option_category_id",
                          "type": "number",
                          "columnObj": {
                            "type": "reference",
                            "primary": false,
                            "nullable": false,
                            "references": "product_categories_id",
                            "inTable": "servo_product_categories",
                            "onUpdate": "RESTRICT",
                            "onDelete": "RESTRICT",
                            "name": "category_option_category_id"
                          }
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "SELECT *\nFROM servo_product_category_options AS servo_product_category_options\nWHERE category_option_category_id = :P1 /* {{servo_product_category_product_category_id}} */",
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{servo_product_category_product_category_id}}"
                    }
                  ]
                },
                "connection": "servodb"
              },
              "output": true,
              "meta": [
                {
                  "type": "number",
                  "name": "category_option_id"
                },
                {
                  "type": "number",
                  "name": "category_option_category_id"
                },
                {
                  "type": "text",
                  "name": "category_option_option"
                }
              ],
              "outputType": "array"
            }
          }
        },
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
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
            "type": "text"
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
            "name": "product_standard_price",
            "type": "number"
          },
          {
            "name": "product_discount",
            "type": "number"
          },
          {
            "name": "product_type",
            "type": "text"
          },
          {
            "name": "product_stock_value",
            "type": "number"
          },
          {
            "name": "product_brand_id",
            "type": "number"
          },
          {
            "name": "product_brand_name",
            "type": "text"
          },
          {
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          },
          {
            "name": "product_price_id",
            "type": "number"
          },
          {
            "name": "product_price",
            "type": "number"
          },
          {
            "name": "product_price_date",
            "type": "datetime"
          },
          {
            "name": "product_price_product_id",
            "type": "number"
          },
          {
            "name": "product_price_department_id",
            "type": "number"
          },
          {
            "name": "product_department",
            "type": "text"
          },
          {
            "name": "query_list_product_category_options",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "category_option_id"
              },
              {
                "type": "number",
                "name": "category_option_category_id"
              },
              {
                "type": "text",
                "name": "category_option_option"
              }
            ]
          }
        ],
        "outputType": "array",
        "output": true
      }
    ]
  }
}
JSON
);
?>