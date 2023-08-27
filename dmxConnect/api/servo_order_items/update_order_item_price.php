<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "order_item_id"
      },
      {
        "type": "number",
        "name": "order_item_price"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_order_item_price",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_order_items",
              "column": "order_item_price",
              "type": "number",
              "value": "{{$_POST.order_item_price}}"
            }
          ],
          "table": "servo_order_items",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "order_item_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.order_item_id}}",
                "data": {
                  "column": "order_item_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_order_items\nSET order_item_price = :P1 /* {{$_POST.order_item_price}} */\nWHERE order_item_id = :P2 /* {{$_POST.order_item_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_item_price}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.order_item_id}}"
            }
          ]
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