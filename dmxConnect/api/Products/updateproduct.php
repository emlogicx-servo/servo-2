<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
      },
      {
        "type": "number",
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "testdb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "products",
              "column": "name",
              "type": "text",
              "value": "{{$_POST.name}}"
            },
            {
              "table": "products",
              "column": "description",
              "type": "text",
              "value": "{{$_POST.description}}"
            },
            {
              "table": "products",
              "column": "current_price",
              "type": "text",
              "value": "{{$_POST.current_price}}"
            },
            {
              "table": "products",
              "column": "picture",
              "type": "text",
              "value": "{{$_POST.picture}}"
            }
          ],
          "table": "products",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.id}}",
                "data": {
                  "column": "id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE products\nSET name = :P1 /* {{$_POST.name}} */, description = :P2 /* {{$_POST.description}} */, current_price = :P3 /* {{$_POST.current_price}} */, picture = :P4 /* {{$_POST.picture}} */\nWHERE id = :P5 /* {{$_POST.id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.description}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.current_price}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.picture}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_POST.id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>