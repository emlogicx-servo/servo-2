<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
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
          "query": "SELECT id, name, description, current_price, picture\nFROM products\nWHERE id = :P1 /* {{$_GET.id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "products.id",
                "field": "products.id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.id}}",
                "data": {
                  "table": "products",
                  "column": "id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
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
      "outputType": "object"
    }
  }
}
JSON
);
?>