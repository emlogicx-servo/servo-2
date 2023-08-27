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
      },
      {
        "type": "text",
        "name": "expenses_deleted_status"
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
              "table": "servo_expenses",
              "column": "expenses_deleted_status",
              "type": "text",
              "value": "{{$_POST.expenses_deleted_status}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_id",
              "type": "number",
              "value": "{{$_POST.expense_id}}"
            }
          ],
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
          "query": "UPDATE servo_expenses\nSET expenses_deleted_status = :P1 /* {{$_POST.expenses_deleted_status}} */, expense_id = :P2 /* {{$_POST.expense_id}} */\nWHERE expense_id = :P3 /* {{$_POST.expense_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.expenses_deleted_status}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.expense_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.expense_id}}",
              "test": ""
            }
          ]
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