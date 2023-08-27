<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_category_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_product_category",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_product_categories",
              "column": "product_category_name",
              "type": "text",
              "value": "{{$_POST.product_category_name}}"
            }
          ],
          "table": "servo_product_categories",
          "returning": "product_categories_id",
          "query": "INSERT INTO servo_product_categories\n(product_category_name) VALUES (:P1 /* {{$_POST.product_category_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_category_name}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>