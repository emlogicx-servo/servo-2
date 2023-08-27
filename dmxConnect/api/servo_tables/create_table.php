<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "table_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_table",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_customer_table",
              "column": "table_name",
              "type": "text",
              "value": "{{$_POST.table_name}}"
            }
          ],
          "table": "servo_customer_table",
          "returning": "table_id",
          "query": "INSERT INTO servo_customer_table\n(table_name) VALUES (:P1 /* {{$_POST.table_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.table_name}}"
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
    }
  }
}
JSON
);
?>