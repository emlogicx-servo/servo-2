<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "customer_transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_customer_cash_transaction",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_customer_cash_transaction",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "customer_transaction_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.customer_transaction_id}}",
                "data": {
                  "column": "customer_transaction_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "customer_transaction_id",
          "query": "DELETE\nFROM servo_customer_cash_transaction\nWHERE customer_transaction_id = :P1 /* {{$_POST.customer_transaction_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.customer_transaction_id}}"
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