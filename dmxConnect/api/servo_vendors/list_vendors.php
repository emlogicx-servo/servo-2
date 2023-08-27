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
      "name": "query_list_vendors",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_vendors"
          },
          "primary": "vendor_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_vendors",
          "params": []
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "vendor_id"
        },
        {
          "type": "text",
          "name": "vendor_name"
        },
        {
          "type": "text",
          "name": "vendor_address"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>