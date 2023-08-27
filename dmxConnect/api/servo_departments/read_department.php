<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "department_id"
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
            "name": "servo_department",
            "alias": "servo_department"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_department.department_id",
                "field": "servo_department.department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department_id}}",
                "data": {
                  "table": "servo_department",
                  "column": "department_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_department AS servo_department\nWHERE department_id = :P1 /* {{$_GET.department_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.department_id}}"
            }
          ],
          "primary": "department_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "text",
          "name": "department_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>