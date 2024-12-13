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
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "category"
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
            "type": "select",
            "distinct": false,
            "columns": [
              {
                "table": "servo_products",
                "column": "*",
                "field": "*"
              }
            ],
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
                      "field": "servo_product_brands.product_brand_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "servo_products",
                        "column": "servo_product_brands_product_brand_id",
                        "field": "servo_products.servo_product_brands_product_brand_id"
                      }
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
                      "field": "servo_product_categories.product_categories_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "servo_products",
                        "column": "servo_product_category_product_category_id",
                        "field": "servo_products.servo_product_category_product_category_id"
                      }
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
                      "field": "servo_product_sub_category.product_sub_category_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "servo_products",
                        "column": "product_sub_category_sub_category_id",
                        "field": "servo_products.product_sub_category_sub_category_id"
                      }
                    }
                  ]
                },
                "primary": "product_sub_category_id"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_products",
                      "column": "product_name",
                      "field": "servo_products.product_name",
                      "operation": "like",
                      "value": "?"
                    }
                  ]
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_products",
                      "column": "servo_product_category_product_category_id",
                      "field": "servo_products.servo_product_category_product_category_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": "?"
                    }
                  ]
                }
              ]
            },
            "orders": [
              {
                "table": "servo_products",
                "column": "product_id",
                "field": "servo_products.product_id",
                "direction": "DESC",
                "recid": 1
              }
            ],
            "params": [],
            "primary": "product_id",
            "query": "select `servo_products`.* from `servo_products` as `servo_products` left join `servo_product_brands` as `servo_product_brands` on `servo_product_brands`.`product_brand_id` = `servo_products`.`servo_product_brands_product_brand_id` left join `servo_product_categories` as `servo_product_categories` on `servo_product_categories`.`product_categories_id` = `servo_products`.`servo_product_category_product_category_id` left join `servo_product_sub_category` on `servo_product_sub_category`.`product_sub_category_id` = `servo_products`.`product_sub_category_sub_category_id` where (`servo_products`.`product_name` like ?) and (`servo_products`.`servo_product_category_product_category_id` = ?) order by `servo_products`.`product_id` DESC"
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
            "type": "text",
            "name": "product_reference_uom"
          }
        ],
        "outputType": "array",
        "output": true,
        "type": "dbconnector_select"
      },
      {
        "name": "list_products_repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query_list_products.data}}",
          "outputFields": [],
          "exec": {
            "steps": {
              "name": "list_product_prices",
              "module": "dbconnector",
              "action": "select",
              "options": {
                "connection": "servodb",
                "sql": {
                  "type": "select",
                  "columns": [],
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{product_id}}",
                      "test": ""
                    }
                  ],
                  "table": {
                    "name": "servo_product_price"
                  },
                  "primary": "product_price_id",
                  "joins": [
                    {
                      "table": "servo_services",
                      "column": "*",
                      "type": "INNER",
                      "clauses": {
                        "condition": "AND",
                        "rules": [
                          {
                            "table": "servo_services",
                            "column": "service_id",
                            "operation": "=",
                            "operator": "equal",
                            "value": {
                              "table": "servo_product_price",
                              "column": "servo_service_service_id",
                              "type": "number"
                            }
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
                        "id": "servo_product_price.product_price_product_id",
                        "field": "servo_product_price.product_price_product_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{product_id}}",
                        "data": {
                          "table": "servo_product_price",
                          "column": "product_price_product_id",
                          "type": "number",
                          "columnObj": {
                            "type": "reference",
                            "primary": false,
                            "nullable": false,
                            "references": "product_id",
                            "inTable": "servo_products",
                            "referenceType": "integer",
                            "onUpdate": "RESTRICT",
                            "onDelete": "RESTRICT",
                            "name": "product_price_product_id"
                          }
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "select * from `servo_product_price` inner join `servo_services` on `servo_services`.`service_id` = `servo_product_price`.`servo_service_service_id` where `servo_product_price`.`product_price_product_id` = ?"
                }
              },
              "meta": [
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
                  "name": "servo_service_service_id"
                },
                {
                  "type": "text",
                  "name": "product_price_code"
                },
                {
                  "type": "number",
                  "name": "product_price_uom_service"
                }
              ],
              "outputType": "array",
              "output": true
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
            "name": "product_min_stock",
            "type": "number"
          },
          {
            "name": "product_expiration_date",
            "type": "datetime"
          },
          {
            "name": "product_sub_category_sub_category_id",
            "type": "number"
          },
          {
            "name": "product_reference_uom",
            "type": "text"
          },
          {
            "name": "list_product_prices",
            "type": "array",
            "sub": [
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
                "name": "servo_service_service_id"
              },
              {
                "type": "text",
                "name": "product_price_code"
              },
              {
                "type": "number",
                "name": "product_price_uom_service"
              }
            ]
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "list_product_categories",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [],
            "params": [],
            "table": {
              "name": "servo_product_categories"
            },
            "primary": "product_categories_id",
            "joins": [],
            "query": "select * from `servo_product_categories`"
          }
        },
        "meta": [
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
    ]
  }
}
JSON
);
?>