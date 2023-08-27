<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "product_group_product_unit_price"
      },
      {
        "type": "number",
        "name": "product_group_item_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_product_group_item_price",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_unit_price",
              "type": "number",
              "value": "{{$_POST.product_group_product_unit_price}}"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_item_id",
              "type": "number",
              "value": "{{$_POST.product_group_item_id}}"
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
          "query": "UPDATE servo_product_group_items\nSET product_group_product_unit_price = :P1 /* {{$_POST.product_group_product_unit_price}} */, product_group_item_id = :P2 /* {{$_POST.product_group_item_id}} */\nWHERE product_group_item_id = :P3 /* {{$_POST.product_group_item_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_group_product_unit_price}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_group_item_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
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