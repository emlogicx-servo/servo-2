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
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "tablefilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_tables",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customer_table"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_customer_table\nWHERE table_name LIKE :P1 /* {{$_GET.tablefilter}} */",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.tablefilter}}"
            }
          ],
          "primary": "table_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customer_table.table_name",
                "field": "servo_customer_table.table_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.tablefilter}}",
                "data": {
                  "table": "servo_customer_table",
                  "column": "table_name",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 45,
                    "primary": false,
                    "nullable": true,
                    "name": "table_name"
                  }
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": []
        }
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
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
          ]
        }
      ],
      "outputType": "object",
      "type": "dbconnector_paged_select"
    }
  }
}
JSON
);
?>