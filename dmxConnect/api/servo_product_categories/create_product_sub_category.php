<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "product_sub_category_category_id"
      },
      {
        "type": "text",
        "name": "product_sub_category_name"
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
              "table": "servo_product_sub_category",
              "column": "product_sub_category_category_id",
              "type": "number",
              "value": "{{$_POST.product_sub_category_category_id}}"
            },
            {
              "table": "servo_product_sub_category",
              "column": "product_sub_category_name",
              "type": "text",
              "value": "{{$_POST.product_sub_category_name}}"
            }
          ],
          "table": "servo_product_sub_category",
          "returning": "product_sub_category_id",
          "query": "INSERT INTO servo_product_sub_category\n(product_sub_category_category_id, product_sub_category_name) VALUES (:P1 /* {{$_POST.product_sub_category_category_id}} */, :P2 /* {{$_POST.product_sub_category_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_sub_category_category_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_sub_category_name}}"
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