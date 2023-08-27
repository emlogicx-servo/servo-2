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
        "type": "number",
        "name": "servo_product_discount_product_discount_id"
      },
      {
        "type": "text",
        "name": "product_description"
      },
      {
        "type": "number",
        "name": "product_id"
      },
      {
        "type": "number",
        "name": "servo_product_category_product_category_id"
      },
      {
        "type": "text",
        "name": "product_type"
      },
      {
        "type": "number",
        "name": "product_min_stock"
      },
      {
        "type": "number",
        "name": "product_sub_category_sub_category_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_product",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
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
              "value": "{{$_POST.product_sub_category_sub_category_id.default(null)}}"
            }
          ],
          "table": "servo_products",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_id}}",
                "data": {
                  "column": "product_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_products\nSET product_name = :P1 /* {{$_POST.product_name}} */, servo_product_brands_product_brand_id = :P2 /* {{$_POST.servo_product_brands_product_brand_id}} */, product_description = :P3 /* {{$_POST.product_description}} */, servo_product_category_product_category_id = :P4 /* {{$_POST.servo_product_category_product_category_id}} */, product_type = :P5 /* {{$_POST.product_type}} */, product_min_stock = :P6 /* {{$_POST.product_min_stock}} */, product_sub_category_sub_category_id = :P7 /* {{$_POST.product_sub_category_sub_category_id.default(null)}} */\nWHERE product_id = :P8 /* {{$_POST.product_id}} */",
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
              "value": "{{$_POST.product_type}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.product_min_stock}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.product_sub_category_sub_category_id.default(null)}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P8",
              "value": "{{$_POST.product_id}}"
            }
          ],
          "returning": "product_id"
        }
      },
      "meta": [
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