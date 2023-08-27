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
        "name": "servo_user_departments_department_id"
      },
      {
        "type": "text",
        "name": "user_profile"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_user",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
          "returning": "user_id",
          "query": "INSERT INTO servo_user\n(user_fname, user_lname, user_username, password, servo_user_departments_department_id, user_profile) VALUES (:P1 /* {{$_POST.user_fname}} */, :P2 /* {{$_POST.user_lname}} */, :P3 /* {{$_POST.user_username}} */, :P4 /* {{$_POST.password}} */, :P5 /* {{$_POST.servo_user_departments_department_id}} */, :P6 /* {{$_POST.user_profile}} */)",
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
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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