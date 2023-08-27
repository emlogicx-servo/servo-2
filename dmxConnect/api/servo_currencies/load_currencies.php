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
      "name": "query_load_currencies",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "params": [],
          "table": {
            "name": "servo_currencies"
          },
          "primary": "currency_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_currencies"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "currency_id"
        },
        {
          "type": "text",
          "name": "currency_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>