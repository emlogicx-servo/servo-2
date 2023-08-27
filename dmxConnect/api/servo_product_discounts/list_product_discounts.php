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
      "name": "query_list_product_discounts",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_discount"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_discount",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_discount_id"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "datetime",
          "name": "product_discount_date"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>