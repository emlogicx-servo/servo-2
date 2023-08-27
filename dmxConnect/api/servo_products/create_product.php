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
        "type": "file",
        "name": "product_picture_file",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
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
        "name": "product_discount"
      },
      {
        "type": "text",
        "name": "product_type"
      },
      {
        "type": "text",
        "name": "product_min_stock"
      },
      {
        "type": "number",
        "name": "product_sub_category_sub_category_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload_product_picture",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/product_pictures",
          "fields": "{{$_POST.product_picture_file}}"
        },
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
        "outputType": "file"
      },
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
                "value": "{{upload_product_picture.name}}"
              },
              {
                "table": "servo_products",
                "column": "servo_product_brands_product_brand_id",
                "type": "number",
                "value": "{{$_POST.servo_product_brands_product_brand_id.default(NULL)}}"
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
                "value": "{{$_POST.servo_product_category_product_category_id.default(NULL)}}"
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
              },
              {
                "table": "servo_products",
                "column": "product_min_stock",
                "type": "number",
                "value": "{{$_POST.product_min_stock}}"
              },
              {
                "table": "servo_products",
                "column": "product_sub_category_sub_category_id",
                "type": "number",
                "value": "{{$_POST.product_sub_category_sub_category_id.default(NULL)}}"
              }
            ],
            "table": "servo_products",
            "returning": "product_id",
            "query": "INSERT INTO servo_products\n(product_name, product_picture, servo_product_brands_product_brand_id, product_description, servo_product_category_product_category_id, product_discount, product_type, product_min_stock, product_sub_category_sub_category_id) VALUES (:P1 /* {{$_POST.product_name}} */, :P2 /* {{upload_product_picture.name}} */, :P3 /* {{$_POST.servo_product_brands_product_brand_id.default(NULL)}} */, :P4 /* {{$_POST.product_description}} */, :P5 /* {{$_POST.servo_product_category_product_category_id.default(NULL)}} */, :P6 /* {{$_POST.product_discount}} */, :P7 /* {{$_POST.product_type}} */, :P8 /* {{$_POST.product_min_stock}} */, :P9 /* {{$_POST.product_sub_category_sub_category_id.default(NULL)}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.product_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{upload_product_picture.name}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.servo_product_brands_product_brand_id.default(NULL)}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.product_description}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.servo_product_category_product_category_id.default(NULL)}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.product_discount}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.product_type}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.product_min_stock}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.product_sub_category_sub_category_id.default(NULL)}}"
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
    ]
  }
}
JSON
);
?>