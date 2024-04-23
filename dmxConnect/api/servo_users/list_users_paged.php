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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "userfilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_users",
      "module": "dbconnector",
      "action": "paged",
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
              "column": "servo_user_departments_department_id"
            },
            {
              "table": "servo_user",
              "column": "user_profile"
            },
            {
              "table": "servo_department",
              "column": "department_id"
            },
            {
              "table": "servo_department",
              "column": "department_name"
            }
          ],
          "table": {
            "name": "servo_user"
          },
          "joins": [
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
                    "value": {
                      "table": "servo_user",
                      "column": "servo_user_departments_department_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "department_id"
            }
          ],
          "query": "select `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_user`.`servo_user_departments_department_id`, `servo_user`.`user_profile`, `servo_department`.`department_id`, `servo_department`.`department_name` from `servo_user` left join `servo_department` on `servo_department`.`department_id` = `servo_user`.`servo_user_departments_department_id` where `servo_user`.`user_fname` like ? or `servo_user`.`user_lname` like ? or `servo_user`.`user_username` like ? order by `servo_user`.`user_fname` ASC",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.userfilter}}"
            },
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.userfilter}}"
            },
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.userfilter}}"
            }
          ],
          "orders": [
            {
              "table": "servo_user",
              "column": "user_fname",
              "direction": "ASC",
              "recid": 1
            }
          ],
          "primary": "user_id",
          "wheres": {
            "condition": "OR",
            "rules": [
              {
                "id": "servo_user.user_fname",
                "field": "servo_user.user_fname",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.userfilter}}",
                "data": {
                  "table": "servo_user",
                  "column": "user_fname",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "default": "",
                    "nullable": true,
                    "maxLength": 45,
                    "primary": false,
                    "name": "user_fname"
                  }
                },
                "operation": "LIKE"
              },
              {
                "id": "servo_user.user_lname",
                "field": "servo_user.user_lname",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.userfilter}}",
                "data": {
                  "table": "servo_user",
                  "column": "user_lname",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "default": "",
                    "nullable": true,
                    "maxLength": 45,
                    "primary": false,
                    "name": "user_lname"
                  }
                },
                "operation": "LIKE"
              },
              {
                "id": "servo_user.user_username",
                "field": "servo_user.user_username",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.userfilter}}",
                "data": {
                  "table": "servo_user",
                  "column": "user_username",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 45,
                    "primary": false,
                    "nullable": false,
                    "name": "user_username"
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
              "type": "number",
              "name": "servo_user_departments_department_id"
            },
            {
              "type": "text",
              "name": "user_profile"
            },
            {
              "type": "number",
              "name": "department_id"
            },
            {
              "type": "text",
              "name": "department_name"
            }
          ]
        }
      ],
      "outputType": "object",
      "output": true,
      "type": "dbconnector_paged_select"
    }
  }
}
JSON
);
?>