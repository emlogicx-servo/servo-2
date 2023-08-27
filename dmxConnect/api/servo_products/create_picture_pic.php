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
        "type": "text",
        "name": "product_picture"
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
      },
      {
        "type": "number",
        "name": "product_discount"
      },
      {
        "type": "text",
        "name": "product_type"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "insert",
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
                "column": "product_picture",
                "type": "text",
                "value": "{{$_POST.product_picture}}"
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
              },
              {
                "table": "servo_products",
                "column": "product_discount",
                "type": "number",
                "value": "{{$_POST.product_discount}}"
              },
              {
                "table": "servo_products",
                "column": "product_type",
                "type": "text",
                "value": "{{$_POST.product_type}}"
              }
            ],
            "table": "servo_products",
            "returning": "product_id",
            "query": "INSERT INTO servo_products\n(product_name, product_picture, servo_product_brands_product_brand_id, product_description, servo_product_category_product_category_id, product_price, product_discount, product_type) VALUES (:P1 /* {{$_POST.product_name}} */, :P2 /* {{$_POST.product_picture}} */, :P3 /* {{$_POST.servo_product_brands_product_brand_id}} */, :P4 /* {{$_POST.product_description}} */, :P5 /* {{$_POST.servo_product_category_product_category_id}} */, :P6 /* {{$_POST.product_price}} */, :P7 /* {{$_POST.product_discount}} */, :P8 /* {{$_POST.product_type}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.product_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.product_picture}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.servo_product_brands_product_brand_id}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.product_description}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.servo_product_category_product_category_id}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.product_price}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.product_discount}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.product_type}}"
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
      },
      {
        "name": "upload_picture",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/product_pictures",
          "replaceSpace": true,
          "throwErrors": true,
          "fields": "{{$_POST.product_picture}}"
        },
        "output": true,
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>