<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "step_description"
      },
      {
        "type": "number",
        "name": "step_users_concerned"
      },
      {
        "type": "datetime",
        "name": "step_end_date"
      },
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
      "name": "update_gugr_step_standard",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_project_step",
              "column": "step_description",
              "type": "text",
              "value": "{{$_POST.step_description}}"
            },
            {
              "table": "servo_project_step",
              "column": "step_users_concerned",
              "type": "number",
              "value": "{{$_POST.step_users_concerned}}"
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
          "query": "UPDATE servo_project_step\nSET step_description = :P1 /* {{$_POST.step_description}} */, step_users_concerned = :P2 /* {{$_POST.step_users_concerned}} */, step_end_date = :P3 /* {{$_POST.step_end_date}} */, step_status = :P4 /* {{$_POST.step_status}} */\nWHERE project_step_id = :P5 /* {{$_POST.project_step_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.step_description}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.step_users_concerned}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.step_end_date}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.step_status}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
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