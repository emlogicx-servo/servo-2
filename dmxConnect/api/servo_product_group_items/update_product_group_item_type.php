<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
      "name": "update_product_group_item_type",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_product_group_items",
              "column": "product_group_item_id",
              "type": "number",
              "value": "{{$_POST.product_group_item_id}}"
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
          "query": "UPDATE servo_product_group_items\nSET product_group_item_id = :P1 /* {{$_POST.product_group_item_id}} */, product_group_item_type = :P2 /* {{$_POST.product_group_item_type}} */\nWHERE product_group_item_id = :P3 /* {{$_POST.product_group_item_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_group_item_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_group_item_type}}"
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