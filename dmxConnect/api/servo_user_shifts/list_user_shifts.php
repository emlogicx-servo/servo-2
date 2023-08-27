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
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_user_shifts",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_user_shifts",
            "alias": "servo_user_shifts"
          },
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "alias": "servo_user",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user_shifts",
                      "column": "servo_user_user_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT *\nFROM servo_user_shifts AS servo_user_shifts\nINNER JOIN servo_user AS servo_user ON (servo_user.user_id = servo_user_shifts.servo_user_user_id)\nWHERE servo_user_shifts.servo_shifts_shift_id = :P1 /* {{$_GET.shift_id}} */\nORDER BY servo_user_shifts.user_shift_id DESC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.shift_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_user_shifts.servo_shifts_shift_id",
                "field": "servo_user_shifts.servo_shifts_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.shift_id}}",
                "data": {
                  "table": "servo_user_shifts",
                  "column": "servo_shifts_shift_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_user_shifts",
              "column": "user_shift_id",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "primary": "user_shift_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "user_shift_id"
        },
        {
          "type": "datetime",
          "name": "time_checkin"
        },
        {
          "type": "datetime",
          "name": "time_checkout"
        },
        {
          "type": "number",
          "name": "balance_checkin"
        },
        {
          "type": "number",
          "name": "balance_checkout"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        },
        {
          "type": "number",
          "name": "servo_shifts_shift_id"
        },
        {
          "type": "text",
          "name": "user_shift_notes"
        },
        {
          "type": "text",
          "name": "user_shift_code"
        },
        {
          "type": "text",
          "name": "assigned"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "number",
          "name": "servo_sales_point_sales_point_id"
        },
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>