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
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_payment_methods"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_payment_methods\nORDER BY payment_method_name ASC",
          "params": [],
          "primary": "payment_method_id",
          "orders": [
            {
              "table": "servo_payment_methods",
              "column": "payment_method_name",
              "direction": "ASC"
            }
          ]
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "payment_method_id"
        },
        {
          "type": "text",
          "name": "payment_method_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>