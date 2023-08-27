<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "payment_method_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_payment_methods"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_payment_methods.payment_method_id",
                "field": "servo_payment_methods.payment_method_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.payment_method_id}}",
                "data": {
                  "table": "servo_payment_methods",
                  "column": "payment_method_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_payment_methods\nWHERE payment_method_id = :P1 /* {{$_GET.payment_method_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.payment_method_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "payment_method_id"
        },
        {
          "type": "text",
          "name": "payment_method_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>