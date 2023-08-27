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
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_users",
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
            },
            {
              "table": "servo_user_profile",
              "column": "user_profile_id"
            },
            {
              "table": "servo_user_profile",
              "column": "user_profile_name"
            },
            {
              "table": "servo_user_shifts",
              "column": "assigned"
            }
          ],
          "table": {
            "name": "servo_user"
          },
          "joins": [
            {
              "table": "servo_department",
              "column": "*",
              "type": "INNER",
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
              }
            },
            {
              "table": "servo_user_profile",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user_profile",
                    "column": "user_profile_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user",
                      "column": "user_profile"
                    },
                    "operation": "="
                  }
                ]
              }
            },
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
              }
            }
          ],
          "query": "SELECT servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.servo_user_departments_department_id, servo_user.user_profile, servo_department.department_id, servo_department.department_name, servo_user_profile.user_profile_id, servo_user_profile.user_profile_name, servo_user_shifts.assigned\nFROM servo_user\nINNER JOIN servo_department ON (servo_department.department_id = servo_user.servo_user_departments_department_id) INNER JOIN servo_user_profile ON (servo_user_profile.user_profile_id = servo_user.user_profile) LEFT JOIN servo_user_shifts ON (servo_user_shifts.servo_user_user_id = servo_user.user_id)",
          "params": []
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
        },
        {
          "type": "number",
          "name": "user_profile_id"
        },
        {
          "type": "text",
          "name": "user_profile_name"
        },
        {
          "type": "text",
          "name": "assigned"
        }
      ],
      "outputType": "array",
      "output": true
    }
  }
}
JSON
);
?>