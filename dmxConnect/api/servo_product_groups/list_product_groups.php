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
    "steps": [
      {
        "name": "list_product_groups",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "servo_product_groups"
            },
            "joins": [],
            "query": "SELECT *\nFROM servo_product_groups",
            "params": []
          },
          "connection": "servodb"
        },
        "meta": [
          {
            "type": "number",
            "name": "product_group_id"
          },
          {
            "type": "text",
            "name": "product_group_name"
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "repeat_list_product_groups",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{list_product_groups}}",
          "outputFields": [
            "product_group_id",
            "product_group_name"
          ],
          "exec": {
            "steps": {
              "name": "query_list_grouped_products",
              "module": "dbconnector",
              "action": "select",
              "options": {
                "sql": {
                  "type": "SELECT",
                  "columns": [],
                  "table": {
                    "name": "servo_product_group_items",
                    "alias": "servo_product_group_items"
                  },
                  "primary": "product_group_item_id",
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
                              "table": "servo_product_group_items",
                              "column": "product_group_product_id",
                              "type": "number"
                            },
                            "operation": "="
                          }
                        ]
                      },
                      "primary": "product_id"
                    }
                  ],
                  "query": "SELECT *\nFROM servo_product_group_items AS servo_product_group_items\nINNER JOIN servo_products AS servo_products ON (servo_products.product_id = servo_product_group_items.product_group_product_id)\nWHERE servo_product_group_items.product_group_product_group_id = :P1 /* {{product_group_id}} */",
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{product_group_id}}"
                    }
                  ],
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "servo_product_group_items.product_group_product_group_id",
                        "field": "servo_product_group_items.product_group_product_group_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{product_group_id}}",
                        "data": {
                          "table": "servo_product_group_items",
                          "column": "product_group_product_group_id",
                          "type": "number",
                          "columnObj": {
                            "type": "reference",
                            "primary": false,
                            "nullable": false,
                            "references": "product_group_id",
                            "inTable": "servo_product_groups",
                            "onUpdate": "RESTRICT",
                            "onDelete": "RESTRICT",
                            "name": "product_group_product_group_id"
                          }
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  }
                },
                "connection": "servodb"
              },
              "output": true,
              "meta": [
                {
                  "type": "number",
                  "name": "product_group_item_id"
                },
                {
                  "type": "number",
                  "name": "product_group_product_id"
                },
                {
                  "type": "number",
                  "name": "product_group_product_quantity"
                },
                {
                  "type": "number",
                  "name": "product_group_product_group_id"
                },
                {
                  "type": "number",
                  "name": "product_group_product_unit_price"
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
                }
              ],
              "outputType": "array"
            }
          }
        },
        "output": true,
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
            "name": "product_group_id",
            "type": "number"
          },
          {
            "name": "product_group_name",
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