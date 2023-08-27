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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "categoryfilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_product_categories",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_categories"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_categories\nWHERE product_category_name LIKE :P1 /* {{$_GET.categoryfilter}} */\nORDER BY product_category_name ASC",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.categoryfilter}}"
            }
          ],
          "primary": "product_categories_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_categories.product_category_name",
                "field": "servo_product_categories.product_category_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.categoryfilter}}",
                "data": {
                  "table": "servo_product_categories",
                  "column": "product_category_name",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 45,
                    "primary": false,
                    "nullable": true,
                    "name": "product_category_name"
                  }
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_product_categories",
              "column": "product_category_name",
              "direction": "ASC"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
            {
              "type": "number",
              "name": "product_categories_id"
            },
            {
              "type": "text",
              "name": "product_category_name"
            }
          ]
        }
      ],
      "outputType": "object",
      "type": "dbconnector_paged_select"
    }
  }
}
JSON
);
?>