<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "category_option_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_category_option",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_category_options"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_category_options.category_option_id",
                "field": "servo_product_category_options.category_option_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.category_option_id}}",
                "data": {
                  "table": "servo_product_category_options",
                  "column": "category_option_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_product_category_options\nWHERE category_option_id = :P1 /* {{$_GET.category_option_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.category_option_id}}"
            }
          ]
        }
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
      "outputType": "object"
    }
  }
}
JSON
);
?>