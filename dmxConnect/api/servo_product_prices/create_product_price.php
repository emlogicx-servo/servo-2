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
        "name": "servo_service_service_id"
      },
      {
        "type": "text",
        "name": "product_price_code"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_product_price",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
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
            },
            {
              "table": "servo_product_price",
              "column": "product_price_product_id",
              "type": "number",
              "value": "{{$_POST.product_price_product_id}}"
            },
            {
              "table": "servo_product_price",
              "column": "servo_service_service_id",
              "type": "number",
              "value": "{{$_POST.servo_service_service_id}}"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_code",
              "type": "text",
              "value": "{{$_POST.product_price_code}}"
            }
          ],
          "table": "servo_product_price",
          "returning": "product_price_id",
          "query": "INSERT INTO servo_product_price\n(product_price, product_price_date, product_price_product_id, servo_service_service_id, product_price_code) VALUES (:P1 /* {{$_POST.product_price}} */, :P2 /* {{$_POST.product_price_date}} */, :P3 /* {{$_POST.product_price_product_id}} */, :P4 /* {{$_POST.servo_service_service_id}} */, :P5 /* {{$_POST.product_price_code}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_price}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.product_price_date}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.product_price_product_id}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.servo_service_service_id}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.product_price_code}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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