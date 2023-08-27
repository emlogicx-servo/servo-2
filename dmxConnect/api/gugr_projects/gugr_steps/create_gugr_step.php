<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "step_project"
      },
      {
        "type": "text",
        "name": "step_description"
      },
      {
        "type": "number",
        "name": "step_user_created"
      },
      {
        "type": "number",
        "name": "step_users_concerned"
      },
      {
        "type": "datetime",
        "name": "step_start_date"
      },
      {
        "type": "datetime",
        "name": "step_end_date"
      },
      {
        "type": "text",
        "name": "step_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_gugr_step",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_project_step",
              "column": "step_project",
              "type": "number",
              "value": "{{$_POST.step_project}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_description",
              "type": "text",
              "value": "{{$_POST.step_description}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_user_created",
              "type": "number",
              "value": "{{$_POST.step_user_created}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_users_concerned",
              "type": "number",
              "value": "{{$_POST.step_users_concerned}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_start_date",
              "type": "datetime",
              "value": "{{$_POST.step_start_date}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_end_date",
              "type": "datetime",
              "value": "{{$_POST.step_end_date}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_status",
              "type": "text",
              "value": "{{$_POST.step_status}}"
            }
          ],
          "table": "servo_project_step",
          "returning": "project_step_id",
          "query": "INSERT INTO servo_project_step\n(step_project, step_description, step_user_created, step_users_concerned, step_start_date, step_end_date, step_status) VALUES (:P1 /* {{$_POST.step_project}} */, :P2 /* {{$_POST.step_description}} */, :P3 /* {{$_POST.step_user_created}} */, :P4 /* {{$_POST.step_users_concerned}} */, :P5 /* {{$_POST.step_start_date}} */, :P6 /* {{$_POST.step_end_date}} */, :P7 /* {{$_POST.step_status}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.step_project}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.step_description}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.step_user_created}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.step_users_concerned}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.step_start_date}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.step_end_date}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.step_status}}",
              "test": ""
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