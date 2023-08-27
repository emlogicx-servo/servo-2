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
    "steps": {
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
            }
          ],
          "query": "SELECT servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.user_profile, servo_user.servo_user_departments_department_id, servo_user_shifts.servo_shifts_shift_id, servo_user_shifts.time_checkin\nFROM servo_user\nLEFT JOIN servo_user_shifts ON (servo_user_shifts.servo_user_user_id = servo_user.user_id)\nWHERE servo_user.user_id = :P1 /* {{$_GET.user_id}} */",
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
        }
      ],
      "outputType": "object",
      "type": "dbconnector_single"
    }
  }
}
JSON
);
?>