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
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_gugr_project",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_projects",
              "column": "project_id"
            },
            {
              "table": "servo_projects",
              "column": "project_code"
            },
            {
              "table": "servo_projects",
              "column": "project_start"
            },
            {
              "table": "servo_projects",
              "column": "project_stop"
            },
            {
              "table": "servo_projects",
              "column": "project_id"
            },
            {
              "table": "servo_projects",
              "column": "project_user_concerned"
            },
            {
              "table": "servo_projects",
              "column": "project_notes"
            },
            {
              "table": "servo_projects",
              "column": "project_status"
            },
            {
              "table": "servo_projects",
              "column": "project_description"
            },
            {
              "table": "servo_projects",
              "column": "project_type"
            },
            {
              "table": "servo_projects",
              "column": "project_date_created"
            },
            {
              "table": "servo_projects",
              "column": "project_date_due"
            },
            {
              "table": "servo_user",
              "column": "user_fname"
            },
            {
              "table": "servo_user",
              "column": "user_lname"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_user",
              "column": "user_profile"
            },
            {
              "table": "servo_projects",
              "column": "project_user_created"
            }
          ],
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
            "name": "servo_projects"
          },
          "primary": "project_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_projects",
                      "column": "project_user_created"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_projects.project_id",
                "field": "servo_projects.project_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.project_id}}",
                "data": {
                  "table": "servo_projects",
                  "column": "project_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "project_id"
                  }
                },
                "operation": "=",
                "table": "servo_projects"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT servo_projects.project_id, servo_projects.project_code, servo_projects.project_start, servo_projects.project_stop, servo_projects.project_id, servo_projects.project_user_concerned, servo_projects.project_notes, servo_projects.project_status, servo_projects.project_description, servo_projects.project_type, servo_projects.project_date_created, servo_projects.project_date_due, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.user_profile, servo_projects.project_user_created\nFROM servo_projects\nLEFT JOIN servo_user ON servo_user.user_id = servo_projects.project_user_created\nWHERE servo_projects.project_id = :P1 /* {{$_GET.project_id}} */"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "project_id"
        },
        {
          "type": "text",
          "name": "project_code"
        },
        {
          "type": "datetime",
          "name": "project_start"
        },
        {
          "type": "datetime",
          "name": "project_stop"
        },
        {
          "type": "number",
          "name": "project_user_concerned"
        },
        {
          "type": "text",
          "name": "project_notes"
        },
        {
          "type": "text",
          "name": "project_status"
        },
        {
          "type": "text",
          "name": "project_description"
        },
        {
          "type": "text",
          "name": "project_type"
        },
        {
          "type": "datetime",
          "name": "project_date_created"
        },
        {
          "type": "datetime",
          "name": "project_date_due"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "number",
          "name": "project_user_created"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>