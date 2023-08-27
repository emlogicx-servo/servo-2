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
        "name": "vendorfilter"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_vendors",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_vendors"
          },
          "primary": "vendor_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_vendors\nWHERE vendor_name LIKE :P1 /* {{$_GET.vendorfilter}} */\nORDER BY vendor_name ASC",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.vendorfilter}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_vendors.vendor_name",
                "field": "servo_vendors.vendor_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.vendorfilter}}",
                "data": {
                  "table": "servo_vendors",
                  "column": "vendor_name",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "maxLength": 65535,
                    "primary": false,
                    "nullable": true,
                    "name": "vendor_name"
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
              "table": "servo_vendors",
              "column": "vendor_name",
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
              "name": "vendor_id"
            },
            {
              "type": "text",
              "name": "vendor_name"
            },
            {
              "type": "text",
              "name": "vendor_address"
            },
            {
              "type": "number",
              "name": "vendor_phone_number"
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