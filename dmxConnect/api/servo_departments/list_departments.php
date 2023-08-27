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
      "name": "query_list_departments",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_department",
            "alias": "servo_department"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_department AS servo_department",
          "params": [],
          "primary": "department_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "text",
          "name": "department_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>