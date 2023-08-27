<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_name"
      },
      {
        "type": "number",
        "name": "servo_product_price_product_price_id"
      },
      {
        "type": "number",
        "name": "servo_product_brands_product_brand_id"
      },
      {
        "type": "text",
        "name": "product_description"
      },
      {
        "type": "number",
        "name": "servo_product_category_product_category_id"
      },
      {
        "type": "number",
        "name": "product_price"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_product",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_products",
              "column": "product_name",
              "type": "text",
              "value": "{{$_POST.product_name}}"
            },
            {
              "table": "servo_products",
              "column": "servo_product_brands_product_brand_id",
              "type": "number",
              "value": "{{$_POST.servo_product_brands_product_brand_id}}"
            },
            {
              "table": "servo_products",
              "column": "product_description",
              "type": "text",
              "value": "{{$_POST.product_description}}"
            },
            {
              "table": "servo_products",
              "column": "servo_product_category_product_category_id",
              "type": "number",
              "value": "{{$_POST.servo_product_category_product_category_id}}"
            },
            {
              "table": "servo_products",
              "column": "product_price",
              "type": "number",
              "value": "{{$_POST.product_price}}"
            }
          ],
          "table": "servo_products",
          "returning": "product_id",
          "query": "INSERT INTO servo_products\n(product_name, servo_product_brands_product_brand_id, product_description, servo_product_category_product_category_id, product_price) VALUES (:P1 /* {{$_POST.product_name}} */, :P2 /* {{$_POST.servo_product_brands_product_brand_id}} */, :P3 /* {{$_POST.product_description}} */, :P4 /* {{$_POST.servo_product_category_product_category_id}} */, :P5 /* {{$_POST.product_price}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.servo_product_brands_product_brand_id}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.product_description}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.servo_product_category_product_category_id}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.product_price}}"
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
      ],
      "output": true
    }
  }
}
JSON
);
?>