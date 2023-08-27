<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "step_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_project_step",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
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
          "query": "DELETE\nFROM servo_project_step\nWHERE project_step_id = :P1 /* {{$_POST.project_step_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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