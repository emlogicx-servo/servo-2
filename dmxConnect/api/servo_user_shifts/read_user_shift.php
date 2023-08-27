<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "user_shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_user_shift",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_user_shifts"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_user_shifts\nWHERE user_shift_id = :P1 /* {{$_GET.user_shift_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.user_shift_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_user_shifts.user_shift_id",
                "field": "servo_user_shifts.user_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.user_shift_id}}",
                "data": {
                  "table": "servo_user_shifts",
                  "column": "user_shift_id",
                  "type": "number"
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
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>