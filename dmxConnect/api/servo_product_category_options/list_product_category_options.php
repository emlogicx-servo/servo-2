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
        "name": "category_id"
      },
      {
        "type": "text",
        "name": "dir"
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
            "name": "servo_product_category_options"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_category_options\nWHERE category_option_category_id = :P1 /* {{$_GET.category_id}} */\nORDER BY category_option_option ASC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.category_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_category_options.category_option_category_id",
                "field": "servo_product_category_options.category_option_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.category_id}}",
                "data": {
                  "table": "servo_product_category_options",
                  "column": "category_option_category_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "primary": "category_option_id",
          "orders": [
            {
              "table": "servo_product_category_options",
              "column": "category_option_option",
              "direction": "ASC"
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
}
JSON
);
?>