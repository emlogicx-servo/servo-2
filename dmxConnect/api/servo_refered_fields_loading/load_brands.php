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
            "name": "servo_product_brands"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_brands",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>