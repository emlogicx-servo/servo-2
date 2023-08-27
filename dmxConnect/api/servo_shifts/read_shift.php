<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_shift",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_shifts"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_shifts.shift_id",
                "field": "servo_shifts.shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.shift_id}}",
                "data": {
                  "table": "servo_shifts",
                  "column": "shift_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_shifts\nWHERE shift_id = :P1 /* {{$_GET.shift_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.shift_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
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
          "type": "boolean",
          "name": "shift_status"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>