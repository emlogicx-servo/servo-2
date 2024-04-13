<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "customer_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_customer",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_customers",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "customer_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.customer_id}}",
                "data": {
                  "column": "customer_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "DELETE\nFROM servo_customers\nWHERE customer_id = :P1 /* {{$_POST.customer_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.customer_id}}"
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