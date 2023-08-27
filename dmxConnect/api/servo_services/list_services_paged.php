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
        "name": "servicefilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_services",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_services",
            "alias": "servo_services"
          },
          "primary": "service_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_services AS servo_services\nWHERE service_name LIKE :P1 /* {{$_GET.servicefilter}} */\nORDER BY service_name ASC",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.servicefilter}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_services.service_name",
                "field": "servo_services.service_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.servicefilter}}",
                "data": {
                  "table": "servo_services",
                  "column": "service_name",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "primary": false,
                    "nullable": false,
                    "maxLength": 128,
                    "name": "service_name"
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
              "table": "servo_services",
              "column": "service_name",
              "direction": "ASC"
            }
          ]
        },
        "connection": "servodb"
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
              "name": "service_id"
            },
            {
              "type": "text",
              "name": "service_name"
            },
            {
              "type": "number",
              "name": "servo_service_sales_point"
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