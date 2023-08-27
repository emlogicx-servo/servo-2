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
        "name": "departmentfilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_departments",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_department",
            "alias": "servo_department"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_department AS servo_department\nWHERE department_name LIKE :P1 /* {{$_GET.departmentfilter}} */\nORDER BY department_name ASC",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.departmentfilter}}"
            }
          ],
          "primary": "department_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_department.department_name",
                "field": "servo_department.department_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.departmentfilter}}",
                "data": {
                  "table": "servo_department",
                  "column": "department_name",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 45,
                    "primary": false,
                    "nullable": false,
                    "name": "department_name"
                  }
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_department",
              "column": "department_name",
              "direction": "ASC"
            }
          ]
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
              "name": "department_id"
            },
            {
              "type": "text",
              "name": "department_name"
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