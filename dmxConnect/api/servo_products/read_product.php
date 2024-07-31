<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_id"
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
        "name": "query_read_product",
        "module": "dbconnector",
        "action": "single",
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
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_products.product_id",
                  "field": "servo_products.product_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.product_id}}",
                  "data": {
                    "table": "servo_products",
                    "column": "product_id",
                    "type": "number",
                    "columnObj": {
                      "type": "increments",
                      "primary": true,
                      "nullable": false,
                      "name": "product_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT *\nFROM servo_products AS servo_products\nLEFT JOIN servo_product_brands AS servo_product_brands ON (servo_product_brands.product_brand_id = servo_products.servo_product_brands_product_brand_id) LEFT JOIN servo_product_categories AS servo_product_categories ON (servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id) LEFT JOIN servo_product_sub_category ON (servo_product_sub_category.product_sub_category_id = servo_products.product_sub_category_sub_category_id)\nWHERE servo_products.product_id = :P1 /* {{$_GET.product_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.product_id}}"
              }
            ],
            "primary": "product_id"
          }
        },
        "output": true,
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
        "outputType": "object"
      },
      {
        "name": "query_read_product_uoms",
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
                "value": "{{$_GET.product_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_product_uom_multiples"
            },
            "primary": "uom_multiple_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_product_uom_multiples.uom_product_id",
                  "field": "servo_product_uom_multiples.uom_product_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.product_id}}",
                  "data": {
                    "table": "servo_product_uom_multiples",
                    "column": "uom_product_id",
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
                      "name": "uom_product_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select * from `servo_product_uom_multiples` where `servo_product_uom_multiples`.`uom_product_id` = ?"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "uom_multiple_id"
          },
          {
            "type": "number",
            "name": "uom_product_id"
          },
          {
            "type": "text",
            "name": "uom_name"
          },
          {
            "type": "number",
            "name": "uom_reference_multiple"
          }
        ],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "query_list_product_prices",
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
                "value": "{{$_GET.product_id}}",
                "test": "13"
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
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_services",
                      "column": "service_id",
                      "operator": "equal",
                      "operation": "=",
                      "value": {
                        "table": "servo_product_price",
                        "column": "servo_service_service_id"
                      }
                    }
                  ]
                },
                "primary": "service_id"
              }
            ],
            "query": "select * from `servo_product_price` left join `servo_services` on `servo_services`.`service_id` = `servo_product_price`.`servo_service_service_id` where `servo_product_price`.`product_price_product_id` = ?",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_product_price.product_price_product_id",
                  "field": "servo_product_price.product_price_product_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.product_id}}",
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
                  "operation": "=",
                  "table": "servo_product_price"
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
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
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>