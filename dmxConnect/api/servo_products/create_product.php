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
      },
      {
        "type": "text",
        "name": "product_reference_uom"
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
              },
              {
                "table": "servo_products",
                "column": "product_reference_uom",
                "type": "text",
                "value": "{{$_POST.product_reference_uom}}"
              }
            ],
            "table": "servo_products",
            "returning": "product_id",
            "query": "insert into `servo_products` (`product_description`, `product_discount`, `product_min_stock`, `product_name`, `product_picture`, `product_reference_uom`, `product_sub_category_sub_category_id`, `product_type`, `servo_product_brands_product_brand_id`, `servo_product_category_product_category_id`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
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
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.product_reference_uom}}",
                "test": ""
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
        "name": "get_last_insert_product",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "text"
          }
        ]
      }
    ]
  }
}
JSON
);
?>