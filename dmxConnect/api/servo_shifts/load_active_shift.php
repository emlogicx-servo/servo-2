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
      "name": "query_load_active_shift",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_shifts"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_shifts\nWHERE shift_status = 'Active'\nORDER BY shift_start ASC",
          "params": [],
          "orders": [
            {
              "table": "servo_shifts",
              "column": "shift_start",
              "direction": "ASC",
              "condition": ""
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
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
          }
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