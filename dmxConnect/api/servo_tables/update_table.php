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
      },
      {
        "type": "number",
        "name": "table_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_table",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_customer_table",
              "column": "table_name",
              "type": "text",
              "value": "{{$_POST.table_name}}"
            }
          ],
          "table": "servo_customer_table",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "table_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.table_id}}",
                "data": {
                  "column": "table_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_customer_table\nSET table_name = :P1 /* {{$_POST.table_name}} */\nWHERE table_id = :P2 /* {{$_POST.table_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.table_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.table_id}}"
            }
          ],
          "returning": "table_id"
        }
      },
      "meta": [
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