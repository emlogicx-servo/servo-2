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
          "columns": [
            {
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_products",
              "column": "product_id"
            }
          ],
          "table": {
            "name": "servo_products"
          },
          "joins": [],
          "query": "SELECT product_name, product_id\nFROM servo_products",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "number",
          "name": "product_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>