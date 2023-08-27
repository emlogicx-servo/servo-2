<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_sub_category_name"
      },
      {
        "type": "number",
        "name": "product_sub_category_id"
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
              "table": "servo_product_sub_category",
              "column": "product_sub_category_name",
              "type": "text",
              "value": "{{$_POST.product_sub_category_name}}"
            },
            {
              "table": "servo_product_sub_category",
              "column": "product_sub_category_id",
              "type": "number",
              "value": "{{$_POST.product_sub_category_id}}"
            }
          ],
          "table": "servo_product_sub_category",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_sub_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_sub_category_id}}",
                "data": {
                  "column": "product_sub_category_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_product_sub_category\nSET product_sub_category_name = :P1 /* {{$_POST.product_sub_category_name}} */, product_sub_category_id = :P2 /* {{$_POST.product_sub_category_id}} */\nWHERE product_sub_category_id = :P3 /* {{$_POST.product_sub_category_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_sub_category_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_sub_category_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.product_sub_category_id}}"
            }
          ],
          "returning": "product_sub_category_id"
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