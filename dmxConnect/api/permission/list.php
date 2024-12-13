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
        "connection": "db",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "servo_permissions",
              "column": "id"
            },
            {
              "table": "servo_permissions",
              "column": "name"
            }
          ],
          "params": [],
          "table": {
            "name": "servo_permissions"
          },
          "primary": "id",
          "joins": [],
          "query": "select `id`, `name` from `servo_permissions`"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "id"
        },
        {
          "type": "text",
          "name": "name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>