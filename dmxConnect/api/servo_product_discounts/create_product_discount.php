<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "product_discount"
      },
      {
        "type": "datetime",
        "name": "product_discount_date"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_product_discount",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_product_discount",
              "column": "product_discount",
              "type": "number",
              "value": "{{$_POST.product_discount}}"
            },
            {
              "table": "servo_product_discount",
              "column": "product_discount_date",
              "type": "datetime",
              "value": "{{$_POST.product_discount_date}}"
            }
          ],
          "table": "servo_product_discount",
          "returning": "product_discount_id",
          "query": "INSERT INTO servo_product_discount\n(product_discount, product_discount_date) VALUES (:P1 /* {{$_POST.product_discount}} */, :P2 /* {{$_POST.product_discount_date}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_discount}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_discount_date}}"
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