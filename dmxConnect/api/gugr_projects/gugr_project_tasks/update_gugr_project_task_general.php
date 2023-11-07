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
        "type": "text",
        "name": "task_status"
      },
      {
        "type": "text",
        "name": "task_description"
      },
      {
        "type": "number",
        "name": "task_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_project_task",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
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
              "column": "task_status",
              "type": "text",
              "value": "{{$_POST.task_status}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_description",
              "type": "text",
              "value": "{{$_POST.task_description}}"
            }
          ],
          "table": "servo_project_tasks",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "task_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.task_id}}",
                "data": {
                  "column": "task_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "task_id",
          "query": "update `servo_project_tasks` set `task_start` = ?, `task_stop` = ?, `task_status` = ?, `task_description` = ? where `task_id` = ?",
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
              "value": "{{$_POST.task_status}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.task_description}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_POST.task_id}}",
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
      ]
    }
  }
}
JSON
);
?>