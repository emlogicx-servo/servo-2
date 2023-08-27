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
          "columns": [
            {
              "table": "products",
              "column": "id"
            },
            {
              "table": "products",
              "column": "name"
            },
            {
              "table": "products",
              "column": "description"
            },
            {
              "table": "products",
              "column": "current_price"
            },
            {
              "table": "products",
              "column": "picture"
            }
          ],
          "table": {
            "name": "products"
          },
          "joins": [],
          "orders": [],
          "query": "SELECT id, name, description, current_price, picture\nFROM products",
          "params": []
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
        },
        {
          "type": "text",
          "name": "description"
        },
        {
          "type": "text",
          "name": "current_price"
        },
        {
          "type": "text",
          "name": "picture"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>