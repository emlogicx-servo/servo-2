<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "user_id"
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
          "columns": [
            {
              "table": "servo_user",
              "column": "user_id"
            },
            {
              "table": "servo_user",
              "column": "user_profile"
            },
            {
              "table": "servo_user",
              "column": "servo_user_departments_department_id"
            }
          ],
          "table": {
            "name": "servo_user",
            "alias": "servo_user"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_user.user_id",
                "field": "servo_user.user_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.user_id}}",
                "data": {
                  "table": "servo_user",
                  "column": "user_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT user_id, user_profile, servo_user_departments_department_id\nFROM servo_user AS servo_user\nWHERE user_id = :P1 /* {{$_GET.user_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.user_id}}"
            }
          ],
          "primary": "user_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "number",
          "name": "servo_user_departments_department_id"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>