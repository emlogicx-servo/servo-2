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
        "name": "address"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "testdb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "customers",
              "column": "name",
              "type": "text",
              "value": "{{$_POST.name}}"
            },
            {
              "table": "customers",
              "column": "address",
              "type": "text",
              "value": "{{$_POST.address}}"
            }
          ],
          "table": "customers",
          "returning": "id",
          "query": "INSERT INTO customers\n(name, address) VALUES (:P1 /* {{$_POST.name}} */, :P2 /* {{$_POST.address}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.address}}"
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
      ]
    }
  }
}
JSON
);
?>