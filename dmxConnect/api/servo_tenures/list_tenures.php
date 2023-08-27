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
      "name": "query_list_tenures",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_user_tenure"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_user_tenure",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "user_tenure_id"
        },
        {
          "type": "datetime",
          "name": "user_tenure_start_date"
        },
        {
          "type": "datetime",
          "name": "user_tenure_end_date"
        },
        {
          "type": "number",
          "name": "user_tenure_branch"
        },
        {
          "type": "number",
          "name": "user_tenure_department"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>