<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "table_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_table",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customer_table"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customer_table.table_id",
                "field": "servo_customer_table.table_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.table_id}}",
                "data": {
                  "table": "servo_customer_table",
                  "column": "table_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_customer_table\nWHERE table_id = :P1 /* {{$_GET.table_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.table_id}}"
            }
          ],
          "primary": "table_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>