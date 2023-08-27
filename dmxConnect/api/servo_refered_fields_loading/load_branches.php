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
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_branches"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_branches",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "branch_id"
        },
        {
          "type": "text",
          "name": "branch_name"
        },
        {
          "type": "datetime",
          "name": "branch_date_registered"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>