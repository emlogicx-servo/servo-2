<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete_project_task",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
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
      "query": "delete from `servo_project_tasks` where `task_id` = ?",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
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
JSON
);
?>