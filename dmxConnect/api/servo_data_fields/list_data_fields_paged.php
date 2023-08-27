<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
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
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "datafield_filter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_data_fields_paged",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_data_fields"
          },
          "primary": "data_field_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_data_fields\nWHERE data_field_name LIKE :P1 /* {{$_GET.datafield_filter}} */",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.datafield_filter}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_data_fields.data_field_name",
                "field": "servo_data_fields.data_field_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.datafield_filter}}",
                "data": {
                  "table": "servo_data_fields",
                  "column": "data_field_name",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "maxLength": 65535,
                    "primary": false,
                    "nullable": false,
                    "name": "data_field_name"
                  }
                },
                "operation": "LIKE"
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
              "name": "data_field_id"
            },
            {
              "type": "text",
              "name": "data_field_name"
            },
            {
              "type": "text",
              "name": "data_field_unit"
            }
          ]
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>