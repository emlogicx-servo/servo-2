<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "product"
      },
      {
        "type": "number",
        "name": "customer"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "testdb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "customer_order",
              "column": "product",
              "type": "number",
              "value": "{{$_POST.product}}"
            },
            {
              "table": "customer_order",
              "column": "customer",
              "type": "number",
              "value": "{{$_POST.customer}}"
            }
          ],
          "table": "customer_order",
          "returning": "id",
          "query": "INSERT INTO customer_order\n(product, customer) VALUES (:P1 /* {{$_POST.product}} */, :P2 /* {{$_POST.customer}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.customer}}"
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
      ],
      "output": true
    }
  }
}
JSON
);
?>