<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "project_id"
      }
    ],
    "$_POST": [
      {
        "type": "number",
        "name": "project_user_concerned"
      },
      {
        "type": "number",
        "name": "project_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_gugr_project_user_concerned",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_projects",
              "column": "project_user_concerned",
              "type": "number",
              "value": "{{$_POST.project_user_concerned}}"
            }
          ],
          "table": "servo_projects",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "project_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.project_id}}",
                "data": {
                  "column": "project_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "project_id",
          "query": "UPDATE servo_projects\nSET project_user_concerned = :P1 /* {{$_POST.project_user_concerned}} */\nWHERE project_id = :P2 /* {{$_POST.project_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.project_user_concerned}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.project_id}}",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>