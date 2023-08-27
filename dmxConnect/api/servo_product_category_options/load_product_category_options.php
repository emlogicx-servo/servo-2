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
        "name": "category"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_product_category_options",
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
          "joins": [],
          "query": "SELECT *\nFROM servo_product_category_options AS servo_product_category_options\nWHERE category_option_category_id = :P1 /* {{$_GET.category}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.category}}"
            }
          ],
          "primary": "category_option_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_category_options.category_option_category_id",
                "field": "servo_product_category_options.category_option_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.category}}",
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
          }
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
}
JSON
);
?>