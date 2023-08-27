<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_group_item_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_product_group_item",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_product_group_items",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_group_item_id",
                "field": "product_group_item_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_group_item_id}}",
                "data": {
                  "column": "product_group_item_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "DELETE\nFROM servo_product_group_items\nWHERE product_group_item_id = :P1 /* {{$_POST.product_group_item_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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
      ]
    }
  }
}
JSON
);
?>