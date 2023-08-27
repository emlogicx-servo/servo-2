<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_category_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "queryReadProductCategory",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_categories"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_categories.product_categories_id",
                "field": "servo_product_categories.product_categories_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_category_id}}",
                "data": {
                  "table": "servo_product_categories",
                  "column": "product_categories_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_product_categories\nWHERE product_categories_id = :P1 /* {{$_GET.product_category_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_category_id}}"
            }
          ]
        }
      },
      "output": true,
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
      "outputType": "object"
    }
  }
}
JSON
);
?>