<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_category_name"
      },
      {
        "type": "number",
        "name": "product_categories_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_product_categories",
              "column": "product_category_name",
              "type": "text",
              "value": "{{$_POST.product_category_name}}"
            }
          ],
          "table": "servo_product_categories",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_categories_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_categories_id}}",
                "data": {
                  "column": "product_categories_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_product_categories\nSET product_category_name = :P1 /* {{$_POST.product_category_name}} */\nWHERE product_categories_id = :P2 /* {{$_POST.product_categories_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_category_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.product_categories_id}}"
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