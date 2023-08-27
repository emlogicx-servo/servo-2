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
        "name": "product_category_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_product_sub_categories",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_sub_category"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_sub_category\nWHERE product_sub_category_category_id = :P1 /* {{$_GET.product_category_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_category_id}}"
            }
          ],
          "primary": "product_sub_category_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_sub_category.product_sub_category_category_id",
                "field": "servo_product_sub_category.product_sub_category_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_category_id}}",
                "data": {
                  "table": "servo_product_sub_category",
                  "column": "product_sub_category_category_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "name": "product_sub_category_category_id"
                  }
                },
                "operation": "="
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
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>