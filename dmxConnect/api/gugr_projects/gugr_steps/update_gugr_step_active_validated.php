<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "step_status"
      },
      {
        "type": "number",
        "name": "project_step_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_gugr_step_active",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_project_step",
              "column": "step_status",
              "type": "text",
              "value": "{{$_POST.step_status}}"
            }
          ],
          "table": "servo_project_step",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "project_step_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.project_step_id}}",
                "data": {
                  "column": "project_step_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "project_step_id",
          "query": "UPDATE servo_project_step\nSET step_status = :P1 /* {{$_POST.step_status}} */\nWHERE project_step_id = :P2 /* {{$_POST.project_step_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.step_status}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.project_step_id}}",
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