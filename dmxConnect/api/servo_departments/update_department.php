<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "department_name"
      },
      {
        "type": "number",
        "name": "department_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_department",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_department",
              "column": "department_name",
              "type": "text",
              "value": "{{$_POST.department_name}}"
            }
          ],
          "table": "servo_department",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.department_id}}",
                "data": {
                  "column": "department_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_department\nSET department_name = :P1 /* {{$_POST.department_name}} */\nWHERE department_id = :P2 /* {{$_POST.department_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.department_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.department_id}}"
            }
          ],
          "returning": "department_id"
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