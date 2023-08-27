<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "user_fname"
      },
      {
        "type": "text",
        "name": "user_lname"
      },
      {
        "type": "text",
        "name": "user_username"
      },
      {
        "type": "text",
        "name": "password"
      },
      {
        "type": "number",
        "name": "servo_user_departments_department_id"
      },
      {
        "type": "number",
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "user_profile"
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
              "table": "servo_user",
              "column": "user_fname",
              "type": "text",
              "value": "{{$_POST.user_fname}}"
            },
            {
              "table": "servo_user",
              "column": "user_lname",
              "type": "text",
              "value": "{{$_POST.user_lname}}"
            },
            {
              "table": "servo_user",
              "column": "user_username",
              "type": "text",
              "value": "{{$_POST.user_username}}"
            },
            {
              "table": "servo_user",
              "column": "password",
              "type": "text",
              "value": "{{$_POST.password}}"
            },
            {
              "table": "servo_user",
              "column": "servo_user_departments_department_id",
              "type": "number",
              "value": "{{$_POST.servo_user_departments_department_id}}"
            },
            {
              "table": "servo_user",
              "column": "user_profile",
              "type": "text",
              "value": "{{$_POST.user_profile}}"
            }
          ],
          "table": "servo_user",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "user_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.user_id}}",
                "data": {
                  "column": "user_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_user\nSET user_fname = :P1 /* {{$_POST.user_fname}} */, user_lname = :P2 /* {{$_POST.user_lname}} */, user_username = :P3 /* {{$_POST.user_username}} */, password = :P4 /* {{$_POST.password}} */, servo_user_departments_department_id = :P5 /* {{$_POST.servo_user_departments_department_id}} */, user_profile = :P6 /* {{$_POST.user_profile}} */\nWHERE user_id = :P7 /* {{$_POST.user_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_fname}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.user_lname}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.user_username}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.password}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.servo_user_departments_department_id}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.user_profile}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P7",
              "value": "{{$_POST.user_id}}"
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