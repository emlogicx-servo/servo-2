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
            "name": "servo_user_profile"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_user_profile",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "user_profile_id"
        },
        {
          "type": "text",
          "name": "user_profile_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>