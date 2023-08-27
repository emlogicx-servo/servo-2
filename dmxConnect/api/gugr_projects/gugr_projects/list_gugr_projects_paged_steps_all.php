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
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_stats",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT\n\n(select count(*) from servo_projects where project_status = 'Active') as Active,\n\n(select count(*) from servo_projects where project_status = 'Pending') as Pending,\n\n(select count(*) from servo_projects where project_status = 'Completed') as Completed",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "Active",
            "type": "text"
          },
          {
            "name": "Pending",
            "type": "text"
          },
          {
            "name": "Completed",
            "type": "text"
          }
        ]
      },
      {
        "name": "query_list_gugr_projects",
        "module": "dbconnector",
        "action": "paged",
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
                "column": "project_user_created"
              },
              {
                "table": "servo_projects",
                "column": "project_status"
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
                "table": "servo_project_step",
                "column": "project_step_id"
              },
              {
                "table": "servo_project_step",
                "column": "step_status"
              },
              {
                "table": "servo_project_step",
                "column": "step_end_date"
              },
              {
                "table": "servo_project_step",
                "column": "step_description"
              }
            ],
            "table": {
              "name": "servo_projects"
            },
            "joins": [
              {
                "table": "servo_project_step",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_project_step",
                      "column": "step_project",
                      "operator": "equal",
                      "value": {
                        "table": "servo_projects",
                        "column": "project_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "project_step_id"
              }
            ],
            "query": "SELECT servo_projects.project_id, servo_projects.project_code, servo_projects.project_user_created, servo_projects.project_status, servo_projects.project_date_created, servo_projects.project_date_due, servo_project_step.project_step_id, servo_project_step.step_status, servo_project_step.step_end_date, servo_project_step.step_description\nFROM servo_projects\nLEFT JOIN servo_project_step ON servo_project_step.step_project = servo_projects.project_id\nWHERE servo_projects.project_status LIKE :P1 /* {{$_GET.gugr_project_status}} */ AND servo_projects.project_code LIKE :P2 /* {{$_GET.gugr_project_filter}} */\nORDER BY servo_projects.project_status DESC, servo_projects.project_date_created DESC, servo_projects.project_code DESC",
            "params": [
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.gugr_project_status}}",
                "test": "%"
              },
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.gugr_project_filter}}",
                "test": "%"
              }
            ],
            "orders": [
              {
                "table": "servo_projects",
                "column": "project_status",
                "direction": "DESC",
                "recid": 1
              },
              {
                "table": "servo_projects",
                "column": "project_date_created",
                "direction": "DESC",
                "recid": 2
              },
              {
                "table": "servo_projects",
                "column": "project_code",
                "direction": "DESC",
                "recid": 3
              }
            ],
            "primary": "project_id",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_projects.project_status",
                  "field": "servo_projects.project_status",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.gugr_project_status}}",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_status",
                    "type": "text",
                    "columnObj": {
                      "type": "enum",
                      "enumValues": [
                        "Pending",
                        "Active",
                        "Completed",
                        "Suspended",
                        "Cancelled",
                        "Paused"
                      ],
                      "maxLength": 9,
                      "primary": false,
                      "nullable": true,
                      "name": "project_status"
                    }
                  },
                  "operation": "LIKE"
                },
                {
                  "id": "servo_projects.project_code",
                  "field": "servo_projects.project_code",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.gugr_project_filter}}",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_code",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "maxLength": 128,
                      "primary": false,
                      "nullable": true,
                      "name": "project_code"
                    }
                  },
                  "operation": "LIKE"
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "project_id"
              },
              {
                "type": "text",
                "name": "project_code"
              },
              {
                "type": "number",
                "name": "project_user_created"
              },
              {
                "type": "text",
                "name": "project_status"
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
                "type": "number",
                "name": "project_step_id"
              },
              {
                "type": "text",
                "name": "step_status"
              },
              {
                "type": "datetime",
                "name": "step_end_date"
              },
              {
                "type": "text",
                "name": "step_description"
              }
            ]
          }
        ],
        "outputType": "object",
        "output": true,
        "type": "dbconnector_paged_select"
      },
      {
        "name": "custom",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select project_code, project_date_due, project_status, step_users_concerned, user_username from servo_projects left join servo_project_step on step_project = project_id left join servo_user on user_id = step_users_concerned",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "project_code",
            "type": "text"
          },
          {
            "name": "project_date_due",
            "type": "datetime"
          },
          {
            "name": "project_status",
            "type": "text"
          },
          {
            "name": "step_users_concerned",
            "type": "number"
          },
          {
            "name": "user_username",
            "type": "text"
          }
        ]
      }
    ]
  }
}
JSON
);
?>