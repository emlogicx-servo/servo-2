<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "product_price"
      },
      {
        "type": "datetime",
        "name": "product_price_date"
      },
      {
        "type": "number",
        "name": "product_price_product_id"
      },
      {
        "type": "number",
        "name": "product_price_id"
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
              "table": "servo_product_price",
              "column": "product_price_id",
              "type": "number",
              "value": "{{$_POST.product_price_id}}"
            },
            {
              "table": "servo_product_price",
              "column": "product_price",
              "type": "number",
              "value": "{{$_POST.product_price}}"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_date",
              "type": "datetime",
              "value": "{{$_POST.product_price_date}}"
            }
          ],
          "table": "servo_product_price",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_price_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_price_id}}",
                "data": {
                  "column": "product_price_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_product_price\nSET product_price_id = :P1 /* {{$_POST.product_price_id}} */, product_price = :P2 /* {{$_POST.product_price}} */, product_price_date = :P3 /* {{$_POST.product_price_date}} */\nWHERE product_price_id = :P4 /* {{$_POST.product_price_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_price_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_price}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.product_price_date}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
              "value": "{{$_POST.product_price_id}}"
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