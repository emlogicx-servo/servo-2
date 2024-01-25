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
      },
      {
        "type": "number",
        "name": "task_user_concerned"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_project_task_details",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_project_tasks",
              "column": "task_description",
              "type": "text",
              "value": "{{$_POST.task_description}}"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_user_concerned",
              "type": "number",
              "value": "{{$_POST.task_user_concerned}}"
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
          "query": "update `servo_project_tasks` set `task_description` = ?, `task_user_concerned` = ? where `task_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.task_description}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.task_user_concerned}}",
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