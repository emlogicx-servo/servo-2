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
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_categories"
          },
          "joins": [],
          "query": "select * from `servo_product_categories` order by `product_category_name` ASC",
          "params": [],
          "primary": "product_categories_id",
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
          "type": "number",
          "name": "product_categories_id"
        },
        {
          "type": "text",
          "name": "product_category_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>