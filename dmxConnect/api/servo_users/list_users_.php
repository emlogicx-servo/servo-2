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
          "columns": [],
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
            }
          ],
          "query": "SELECT *\nFROM servo_user\nINNER JOIN servo_department ON (servo_department.department_id = servo_user.servo_user_departments_department_id) INNER JOIN servo_user_profile ON (servo_user_profile.user_profile_id = servo_user.user_profile)",
          "params": [],
          "orders": []
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
          "type": "text",
          "name": "password"
        },
        {
          "type": "number",
          "name": "servo_user_profile_user_profile_id"
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>