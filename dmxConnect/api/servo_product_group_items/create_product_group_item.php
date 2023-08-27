<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_group_name"
      },
      {
        "type": "number",
        "name": "product_group_product_id"
      },
      {
        "type": "number",
        "name": "product_group_product_quantity"
      },
      {
        "type": "number",
        "name": "product_group_product_group_id"
      },
      {
        "type": "number",
        "name": "product_group_product_unit_price"
      },
      {
        "type": "text",
        "name": "product_group_item_type"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_product_group_item",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_id",
              "type": "number",
              "value": "{{$_POST.product_group_product_id}}"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_quantity",
              "type": "number",
              "value": "{{$_POST.product_group_product_quantity}}"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_group_id",
              "type": "number",
              "value": "{{$_POST.product_group_product_group_id}}"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_unit_price",
              "type": "number",
              "value": "{{$_POST.product_group_product_unit_price}}"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_item_type",
              "type": "text",
              "value": "{{$_POST.product_group_item_type}}"
            }
          ],
          "table": "servo_product_group_items",
          "returning": "product_group_item_id",
          "query": "INSERT INTO servo_product_group_items\n(product_group_product_id, product_group_product_quantity, product_group_product_group_id, product_group_product_unit_price, product_group_item_type) VALUES (:P1 /* {{$_POST.product_group_product_id}} */, :P2 /* {{$_POST.product_group_product_quantity}} */, :P3 /* {{$_POST.product_group_product_group_id}} */, :P4 /* {{$_POST.product_group_product_unit_price}} */, :P5 /* {{$_POST.product_group_item_type}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_group_product_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_group_product_quantity}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.product_group_product_group_id}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.product_group_product_unit_price}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.product_group_item_type}}"
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