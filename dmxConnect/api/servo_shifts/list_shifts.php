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
      "name": "query_list_shifts",
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
          "query": "SELECT *\nFROM servo_shifts\nORDER BY shift_id DESC",
          "params": [],
          "primary": "shift_id",
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