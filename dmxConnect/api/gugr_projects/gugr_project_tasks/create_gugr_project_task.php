<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "task_start"
      },
      {
        "type": "datetime",
        "name": "task_stop"
      },
      {
        "type": "number",
        "name": "task_user_created"
      },
      {
        "type": "number",
        "name": "task_user_concerned"
      },
      {
        "type": "text",
        "name": "task_status"
      },
      {
        "type": "text",
        "name": "task_description"
      },
      {
        "type": "datetime",
        "name": "task_date_created"
      },
      {
        "type": "datetime",
        "name": "task_date_due"
      },
      {
        "type": "number",
        "name": "task_project"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_gugr_project_task",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_project_tasks",
              "column": "task_start",
              "type": "datetime",
              "value": "{{$_POST.task_start}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_stop",
              "type": "datetime",
              "value": "{{$_POST.task_stop}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_user_created",
              "type": "number",
              "value": "{{$_POST.task_user_created}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_user_concerned",
              "type": "number",
              "value": "{{$_POST.task_user_concerned}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_status",
              "type": "text",
              "value": "{{$_POST.task_status}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_description",
              "type": "text",
              "value": "{{$_POST.task_description}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_date_created",
              "type": "datetime",
              "value": "{{$_POST.task_date_created}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_date_due",
              "type": "datetime",
              "value": "{{$_POST.task_date_due}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_project",
              "type": "number",
              "value": "{{$_POST.task_project.default(null))}}"
            }
          ],
          "table": "servo_project_tasks",
          "returning": "task_id",
          "query": "insert into `servo_project_tasks` (`task_date_created`, `task_date_due`, `task_description`, `task_project`, `task_start`, `task_status`, `task_stop`, `task_user_concerned`, `task_user_created`) values (?, ?, ?, ?, ?, ?, ?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.task_start}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.task_stop}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.task_user_created}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.task_user_concerned}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.task_status}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.task_description}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.task_date_created}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.task_date_due}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.task_project.default(null))}}",
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