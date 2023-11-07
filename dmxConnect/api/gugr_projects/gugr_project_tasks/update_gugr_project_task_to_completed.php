<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "task_status"
      },
      {
        "type": "datetime",
        "name": "task_date_completed"
      },
      {
        "type": "number",
        "name": "task_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_task_to_complete",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_project_tasks",
              "column": "task_status",
              "type": "text",
              "value": "{{$_POST.task_status}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_date_completed",
              "type": "datetime",
              "value": "{{$_POST.task_date_completed}}"
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
          "query": "update `servo_project_tasks` set `task_status` = ?, `task_date_completed` = ? where `task_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.task_status}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.task_date_completed}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
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