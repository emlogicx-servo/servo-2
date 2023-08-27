<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_brand_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_product_brand",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_product_brands",
              "column": "product_brand_name",
              "type": "text",
              "value": "{{$_POST.product_brand_name}}"
            }
          ],
          "table": "servo_product_brands",
          "returning": "product_brand_id",
          "query": "INSERT INTO servo_product_brands\n(product_brand_name) VALUES (:P1 /* {{$_POST.product_brand_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_brand_name}}"
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