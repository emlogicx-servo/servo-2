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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "project_step_status"
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
            "query": "SELECT\n\n(select count(*) from servo_project_step where step_status = 'Active') as Active,\n\n(select count(*) from servo_project_step where step_status = 'Pending') as Pending,\n\n(select count(*) from servo_project_step where step_status = 'Completed') as Completed",
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
            "distinct": false,
            "columns": [
              {
                "table": "servo_project_step",
                "column": "project_step_id",
                "field": "servo_project_step.project_step_id"
              },
              {
                "table": "servo_project_step",
                "column": "step_status",
                "field": "servo_project_step.step_status"
              },
              {
                "table": "servo_project_step",
                "column": "step_end_date",
                "field": "servo_project_step.step_end_date"
              },
              {
                "table": "servo_project_step",
                "column": "step_description",
                "field": "servo_project_step.step_description"
              },
              {
                "table": "servo_user",
                "column": "user_fname",
                "field": "servo_user.user_fname"
              },
              {
                "table": "servo_user",
                "column": "user_lname",
                "field": "servo_user.user_lname"
              },
              {
                "table": "servo_projectS",
                "column": "project_id"
              },
              {
                "table": "servo_projectS",
                "column": "project_code"
              }
            ],
            "table": {
              "name": "servo_project_step"
            },
            "joins": [
              {
                "table": "servo_projects",
                "column": "*",
                "alias": "servo_projectS",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_project_step",
                      "column": "step_project",
                      "field": "servo_project_step.step_project",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "servo_projects",
                        "column": "project_id",
                        "field": "servo_projects.project_id"
                      }
                    }
                  ]
                },
                "primary": "project_id"
              },
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
                      "field": "servo_user.user_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "servo_project_step",
                        "column": "step_users_concerned",
                        "field": "servo_project_step.step_users_concerned"
                      }
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
                  "id": "servo_project_step.step_status",
                  "field": "servo_project_step.step_status",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_GET.project_step_status}}",
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
                  "operation": "="
                }
              ],
              "conditional": "{{$_GET.project_step_status}}",
              "valid": true
            },
            "orders": [
              {
                "table": "servo_projects",
                "column": "project_id",
                "field": "servo_projects.project_id",
                "direction": "DESC",
                "recid": 1
              },
              {
                "table": "servo_projects",
                "column": "project_start",
                "field": "servo_projects.project_start",
                "direction": "DESC",
                "recid": 2
              },
              {
                "table": "servo_projects",
                "column": "project_stop",
                "field": "servo_projects.project_stop",
                "direction": "DESC",
                "recid": 3
              },
              {
                "table": "servo_user",
                "column": "user_fname",
                "field": "servo_user.user_fname",
                "direction": "DESC",
                "recid": 4
              },
              {
                "table": "servo_projects",
                "column": "project_status",
                "field": "servo_projects.project_status",
                "direction": "DESC",
                "recid": 5
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.project_step_status}}",
                "test": ""
              }
            ],
            "primary": "project_step_id",
            "query": "select `servo_project_step`.`project_step_id`, `servo_project_step`.`step_status`, `servo_project_step`.`step_end_date`, `servo_project_step`.`step_description`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_projectS`.`project_id`, `servo_projectS`.`project_code` from `servo_project_step` left join `servo_projects` as `servo_projectS` on `servo_project_step`.`step_project` = `servo_projects`.`project_id` left join `servo_user` on `servo_user`.`user_id` = `servo_project_step`.`step_users_concerned` where `servo_project_step`.`step_status` = ? order by `servo_projects`.`project_id` DESC, `servo_projects`.`project_start` DESC, `servo_projects`.`project_stop` DESC, `servo_user`.`user_fname` DESC, `servo_projects`.`project_status` DESC"
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
                "type": "number",
                "name": "project_id"
              },
              {
                "type": "text",
                "name": "project_code"
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