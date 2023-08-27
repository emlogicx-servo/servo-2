<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "expense_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_expense",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_expenses",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "expense_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.expense_id}}",
                "data": {
                  "column": "expense_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "expense_id",
          "query": "DELETE\nFROM servo_expenses\nWHERE expense_id = :P1 /* {{$_POST.expense_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.expense_id}}"
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