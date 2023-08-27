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
        "name": "shiftfilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_shifts",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_shifts"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_shifts\nWHERE shift_start >= :P1 /* {{$_GET.shiftfilter}} */\nORDER BY shift_id DESC",
          "params": [
            {
              "operator": "greater_or_equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.shiftfilter}}"
            }
          ],
          "primary": "shift_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_shifts.shift_start",
                "field": "servo_shifts.shift_start",
                "type": "datetime",
                "operator": "greater_or_equal",
                "value": "{{$_GET.shiftfilter}}",
                "data": {
                  "table": "servo_shifts",
                  "column": "shift_start",
                  "type": "datetime",
                  "columnObj": {
                    "type": "datetime",
                    "primary": false,
                    "nullable": true,
                    "name": "shift_start"
                  }
                },
                "operation": ">="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_shifts",
              "column": "shift_id",
              "direction": "DESC"
            }
          ]
        }
      },
      "output": true,
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
          ]
        }
      ],
      "outputType": "object",
      "type": "dbconnector_paged_select"
    }
  }
}
JSON
);
?>