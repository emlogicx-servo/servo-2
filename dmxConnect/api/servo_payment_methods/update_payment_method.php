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
      },
      {
        "type": "number",
        "name": "payment_method_id"
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
              "table": "servo_payment_methods",
              "column": "payment_method_name",
              "type": "text",
              "value": "{{$_POST.payment_method_name}}"
            }
          ],
          "table": "servo_payment_methods",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "payment_method_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.payment_method_id}}",
                "data": {
                  "column": "payment_method_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_payment_methods\nSET payment_method_name = :P1 /* {{$_POST.payment_method_name}} */\nWHERE payment_method_id = :P2 /* {{$_POST.payment_method_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.payment_method_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.payment_method_id}}"
            }
          ],
          "returning": "payment_method_id"
        }
      },
      "meta": [
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