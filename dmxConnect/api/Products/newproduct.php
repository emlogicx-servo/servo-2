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
    ],
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
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "insert",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "testdb",
          "sql": {
            "type": "insert",
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
            "returning": "id",
            "query": "INSERT INTO products\n(name, description, current_price, picture) VALUES (:P1 /* {{$_POST.name}} */, :P2 /* {{$_POST.description}} */, :P3 /* {{$_POST.current_price}} */, :P4 /* {{$_POST.picture}} */)",
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
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      },
      {
        "name": "custom",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "testdb",
          "sql": {
            "query": "SELECT last_insert_id();",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "currentorder",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{custom[0]['last_insert_id()']}}"
        },
        "meta": [],
        "output": true,
        "outputType": "number"
      }
    ]
  }
}
JSON
);
?>