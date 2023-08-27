<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_group_tem_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "read_product_group_item",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_group_items",
            "alias": "servo_product_group_items"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_group_items AS servo_product_group_items\nWHERE product_group_item_id = :P1 /* {{$_GET.product_group_tem_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_group_tem_id}}"
            }
          ],
          "primary": "product_group_item_id",
          "orders": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_group_items.product_group_item_id",
                "field": "servo_product_group_items.product_group_item_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_group_tem_id}}",
                "data": {
                  "table": "servo_product_group_items",
                  "column": "product_group_item_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "product_group_item_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_group_item_id"
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
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>