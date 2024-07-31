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
        "name": "user_concerned"
      },
      {
        "type": "text",
        "name": "step_status"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
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
            "query": "SELECT\n\n(select count(*) from servo_project_step where step_status = 'Active' and step_users_concerned = :P1) as StepActive,\n\n(select count(*) from servo_project_step where step_status = 'Pending' and step_users_concerned = :P1) as StepPending,\n\n(select count(*) from servo_project_step where step_status = 'Completed' and step_users_concerned = :P1) as StepCompleted",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.user_concerned}}",
                "test": "1"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "StepActive",
            "type": "text"
          },
          {
            "name": "StepPending",
            "type": "text"
          },
          {
            "name": "StepCompleted",
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
            "query": "select `servo_projects`.`project_id`, `servo_projects`.`project_code`, `servo_projects`.`project_user_created`, `servo_projects`.`project_status`, `servo_projects`.`project_date_created`, `servo_projects`.`project_date_due`, `servo_project_step`.`project_step_id`, `servo_project_step`.`step_status`, `servo_project_step`.`step_end_date`, `servo_project_step`.`step_description` from `servo_projects` left join `servo_project_step` on `servo_project_step`.`step_project` = `servo_projects`.`project_id` where `servo_project_step`.`step_users_concerned` = ? and (`servo_project_step`.`step_status` = ?) order by `servo_project_step`.`project_step_id` DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.user_concerned}}",
                "test": "1"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.step_status}}",
                "test": ""
              }
            ],
            "orders": [
              {
                "table": "servo_project_step",
                "column": "project_step_id",
                "direction": "DESC"
              }
            ],
            "primary": "project_id",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_project_step.step_users_concerned",
                  "field": "servo_project_step.step_users_concerned",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.user_concerned}}",
                  "data": {
                    "table": "servo_project_step",
                    "column": "step_users_concerned",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "default": "",
                      "primary": false,
                      "nullable": true,
                      "references": "user_id",
                      "inTable": "servo_user",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "step_users_concerned"
                    }
                  },
                  "operation": "=",
                  "table": "servo_projects"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_project_step.step_status",
                      "field": "servo_project_step.step_status",
                      "type": "string",
                      "operator": "equal",
                      "value": "{{$_GET.step_status}}",
                      "data": {
                        "table": "servo_project_step",
                        "column": "step_status",
                        "type": "text",
                        "columnObj": {
                          "type": "enum",
                          "enumValues": [
                            "Active",
                            "Pending",
                            "Suspended",
                            "Completed"
                          ],
                          "default": "",
                          "maxLength": 9,
                          "primary": false,
                          "nullable": true,
                          "name": "step_status"
                        }
                      },
                      "operation": "=",
                      "table": "servo_projects"
                    }
                  ],
                  "conditional": "{{$_GET.step_status}}",
                  "table": "servo_projects",
                  "id": "servo_projects.undefined"
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