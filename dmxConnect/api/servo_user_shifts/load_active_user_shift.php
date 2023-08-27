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
      "name": "query_load_active_user_shift",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_user_shifts"
          },
          "joins": [
            {
              "table": "servo_shifts",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_shifts",
                    "column": "shift_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user_shifts",
                      "column": "servo_shifts_shift_id"
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT *\nFROM servo_user_shifts\nINNER JOIN servo_shifts ON (servo_shifts.shift_id = servo_user_shifts.servo_shifts_shift_id)\nWHERE servo_user_shifts.servo_user_user_id = :P1 /* {{$_GET.user_id}} */ AND servo_shifts.shift_status = 'Active'",
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
                "id": "servo_user_shifts.servo_user_user_id",
                "field": "servo_user_shifts.servo_user_user_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.user_id}}",
                "data": {
                  "table": "servo_user_shifts",
                  "column": "servo_user_user_id",
                  "type": "number"
                },
                "operation": "="
              },
              {
                "id": "servo_shifts.shift_status",
                "field": "servo_shifts.shift_status",
                "type": "string",
                "operator": "equal",
                "value": "Active",
                "data": {
                  "table": "servo_shifts",
                  "column": "shift_status",
                  "type": "text"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": []
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
          "type": "number",
          "name": "shift_id"
        },
        {
          "type": "datetime",
          "name": "shift_start"
        },
        {
          "type": "datetime",
          "name": "shift_stop"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
        },
        {
          "type": "text",
          "name": "shift_status"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>