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
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "user_username"
      },
      {
        "type": "text",
        "name": "password"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "identity",
        "module": "auth",
        "action": "login",
        "options": {
          "provider": "servo_login",
          "remember": "",
          "username": "{{$_POST.user_username}}"
        },
        "output": true,
        "meta": []
      },
      {
        "name": "query_get_user_role",
        "module": "dbconnector",
        "action": "select",
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
            "query": "SELECT servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.servo_user_departments_department_id, servo_user.user_profile, servo_department.department_id, servo_department.department_name\nFROM servo_user\nLEFT JOIN servo_department ON (servo_department.department_id = servo_user.servo_user_departments_department_id)\nWHERE servo_user.user_id = :P1 /* {{identity}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{identity}}"
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
                  "value": "{{identity}}",
                  "data": {
                    "table": "servo_user",
                    "column": "user_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "primary": "user_id"
          }
        },
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
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "userloginInfo",
        "module": "core",
        "action": "setsession",
        "options": {
          "value": "{{query_get_user_role}}"
        }
      },
      {
        "name": "servotheme",
        "module": "core",
        "action": "setcookie",
        "options": {
          "value": "light"
        }
      }
    ]
  }
}
JSON
);
?>