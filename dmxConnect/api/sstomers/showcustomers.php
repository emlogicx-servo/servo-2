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
        "connection": "testdb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "customer",
            "alias": "customers"
          },
          "joins": [],
          "query": "SELECT *\nFROM customer AS customers",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>