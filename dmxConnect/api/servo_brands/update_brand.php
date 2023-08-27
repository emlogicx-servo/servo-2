<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_brand_name"
      },
      {
        "type": "number",
        "name": "product_brand_id"
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
              "table": "servo_product_brands",
              "column": "product_brand_name",
              "type": "text",
              "value": "{{$_POST.product_brand_name}}"
            }
          ],
          "table": "servo_product_brands",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_brand_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_brand_id}}",
                "data": {
                  "column": "product_brand_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_product_brands\nSET product_brand_name = :P1 /* {{$_POST.product_brand_name}} */\nWHERE product_brand_id = :P2 /* {{$_POST.product_brand_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_brand_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.product_brand_id}}"
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