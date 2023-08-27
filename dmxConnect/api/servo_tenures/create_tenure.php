<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "user_tenure_start_date"
      },
      {
        "type": "datetime",
        "name": "user_tenure_end_date"
      },
      {
        "type": "number",
        "name": "user_tenure_branch"
      },
      {
        "type": "number",
        "name": "user_tenure_department"
      },
      {
        "type": "number",
        "name": "servo_user_user_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_tenure",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_user_tenure",
              "column": "user_tenure_start_date",
              "type": "datetime",
              "value": "{{$_POST.user_tenure_start_date}}"
            },
            {
              "table": "servo_user_tenure",
              "column": "user_tenure_end_date",
              "type": "datetime",
              "value": "{{$_POST.user_tenure_end_date}}"
            },
            {
              "table": "servo_user_tenure",
              "column": "user_tenure_branch",
              "type": "number",
              "value": "{{$_POST.user_tenure_branch}}"
            },
            {
              "table": "servo_user_tenure",
              "column": "user_tenure_department",
              "type": "number",
              "value": "{{$_POST.user_tenure_department}}"
            },
            {
              "table": "servo_user_tenure",
              "column": "servo_user_user_id",
              "type": "number",
              "value": "{{$_POST.servo_user_user_id}}"
            }
          ],
          "table": "servo_user_tenure",
          "returning": "user_tenure_id",
          "query": "INSERT INTO servo_user_tenure\n(user_tenure_start_date, user_tenure_end_date, user_tenure_branch, user_tenure_department, servo_user_user_id) VALUES (:P1 /* {{$_POST.user_tenure_start_date}} */, :P2 /* {{$_POST.user_tenure_end_date}} */, :P3 /* {{$_POST.user_tenure_branch}} */, :P4 /* {{$_POST.user_tenure_department}} */, :P5 /* {{$_POST.servo_user_user_id}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_tenure_start_date}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.user_tenure_end_date}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.user_tenure_branch}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.user_tenure_department}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.servo_user_user_id}}"
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