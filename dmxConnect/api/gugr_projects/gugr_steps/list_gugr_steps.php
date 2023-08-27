<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "project_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_project_steps",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.project_id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "servo_project_step"
          },
          "primary": "project_step_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_project_step\nWHERE step_project = :P1 /* {{$_GET.project_id}} */\nORDER BY project_step_id DESC",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_project_step.step_project",
                "field": "servo_project_step.step_project",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.project_id}}",
                "data": {
                  "table": "servo_project_step",
                  "column": "step_project",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "project_id",
                    "inTable": "servo_projects",
                    "referenceType": "integer",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "step_project"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_project_step",
              "column": "project_step_id",
              "direction": "DESC"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "project_step_id"
        },
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
          "name": "step_department_concerned"
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
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>