<?php
require('../../../dmxConnectLib/dmxConnect.php');


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
        "name": "user_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "user_permission",
        "module": "arraylist",
        "action": "create",
        "options": {},
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "identity",
        "module": "auth",
        "action": "identify",
        "options": {
          "provider": "servo_login"
        },
        "output": true,
        "meta": []
      },
      {
        "name": "user_permission_query",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT servo_permissions.name\nFROM servo_permissions\nINNER JOIN servo_permissions_role\nON servo_permissions.id = servo_permissions_role.permission_id\nWHERE servo_permissions_role.role_id \nIN (SELECT servo_role_user.role_id\n        FROM servo_role_user\n        WHERE servo_role_user.user_id = ?\n        GROUP BY servo_role_user.role_id\n        )\nGROUP BY servo_permissions.id",
            "params": [
              {
                "name": "?",
                "value": "{{identity}}",
                "test": "1"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          }
        ]
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{user_permission_query}}",
          "outputFields": [],
          "exec": {
            "steps": {
              "name": "",
              "module": "arraylist",
              "action": "add",
              "options": {
                "ref": "user_permission",
                "value": "{{name}}"
              }
            }
          }
        },
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "user_permissions",
        "module": "arraylist",
        "action": "value",
        "options": {
          "ref": "user_permission"
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "query_list_user_info",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_user",
                "column": "user_id"
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
                "table": "servo_user",
                "column": "servo_user_departments_department_id"
              },
              {
                "table": "servo_user_shifts",
                "column": "servo_shifts_shift_id"
              },
              {
                "table": "servo_user_shifts",
                "column": "time_checkin"
              },
              {
                "table": "servo_department",
                "column": "department_name"
              }
            ],
            "table": {
              "name": "servo_user"
            },
            "primary": "user_id",
            "joins": [
              {
                "table": "servo_user_shifts",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_user_shifts",
                      "column": "servo_user_user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_user",
                        "column": "user_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_shift_id"
              },
              {
                "table": "servo_department",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_department",
                      "column": "department_id",
                      "operator": "equal",
                      "operation": "=",
                      "value": {
                        "table": "servo_user",
                        "column": "servo_user_departments_department_id"
                      }
                    }
                  ]
                },
                "primary": "department_id"
              }
            ],
            "query": "select `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_user`.`user_profile`, `servo_user`.`servo_user_departments_department_id`, `servo_user_shifts`.`servo_shifts_shift_id`, `servo_user_shifts`.`time_checkin`, `servo_department`.`department_name` from `servo_user` left join `servo_user_shifts` on `servo_user_shifts`.`servo_user_user_id` = `servo_user`.`user_id` left join `servo_department` on `servo_department`.`department_id` = `servo_user`.`servo_user_departments_department_id` where `servo_user`.`user_id` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.user_id}}"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_user.user_id",
                  "field": "servo_user.user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.user_id}}",
                  "data": {
                    "table": "servo_user",
                    "column": "user_id",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "primary": true,
                      "name": "user_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "user_id"
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
            "name": "servo_user_departments_department_id"
          },
          {
            "type": "number",
            "name": "servo_shifts_shift_id"
          },
          {
            "type": "datetime",
            "name": "time_checkin"
          },
          {
            "type": "text",
            "name": "department_name"
          }
        ],
        "outputType": "object",
        "type": "dbconnector_single"
      }
    ]
  }
}
JSON
);
?>