<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
        "type": "number",
        "name": "product_group_item_id"
      },
      {
        "type": "text",
        "name": "product_group_item_type"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_product_group_item",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
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
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_group_item_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_group_item_id}}",
                "data": {
                  "column": "product_group_item_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_product_group_items\nSET product_group_product_id = :P1 /* {{$_POST.product_group_product_id}} */, product_group_product_quantity = :P2 /* {{$_POST.product_group_product_quantity}} */, product_group_product_group_id = :P3 /* {{$_POST.product_group_product_group_id}} */, product_group_product_unit_price = :P4 /* {{$_POST.product_group_product_unit_price}} */, product_group_item_type = :P5 /* {{$_POST.product_group_item_type}} */\nWHERE product_group_item_id = :P6 /* {{$_POST.product_group_item_id}} */",
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
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.product_group_item_id}}"
            }
          ],
          "returning": "product_group_item_id"
        }
      },
      "meta": [
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