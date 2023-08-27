<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "payment_method_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_payment_methods",
              "column": "payment_method_name",
              "type": "text",
              "value": "{{$_POST.payment_method_name}}"
            }
          ],
          "table": "servo_payment_methods",
          "returning": "payment_method_id",
          "query": "INSERT INTO servo_payment_methods\n(payment_method_name) VALUES (:P1 /* {{$_POST.payment_method_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.payment_method_name}}"
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