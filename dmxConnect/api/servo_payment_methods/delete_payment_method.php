<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "payment_method_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
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
          "query": "DELETE\nFROM servo_payment_methods\nWHERE payment_method_id = :P1 /* {{$_POST.payment_method_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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
      ]
    }
  }
}
JSON
);
?>