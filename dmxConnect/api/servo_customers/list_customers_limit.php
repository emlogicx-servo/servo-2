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
        "name": "customerfilter"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_customers",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customers"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_customers\nWHERE customer_first_name LIKE :P1 /* {{$_GET.customerfilter}} */ OR customer_last_name LIKE :P2 /* {{$_GET.customerfilter}} */ OR customer_phone_number <= :P3 /* {{$_GET.customerfilter}} */\nORDER BY customer_first_name ASC",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customerfilter}}"
            },
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.customerfilter}}"
            },
            {
              "operator": "less_or_equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.customerfilter}}"
            }
          ],
          "primary": "customer_id",
          "wheres": {
            "condition": "OR",
            "rules": [
              {
                "id": "servo_customers.customer_first_name",
                "field": "servo_customers.customer_first_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.customerfilter}}",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_first_name",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "maxLength": 65535,
                    "primary": false,
                    "nullable": false,
                    "name": "customer_first_name"
                  }
                },
                "operation": "LIKE"
              },
              {
                "id": "servo_customers.customer_last_name",
                "field": "servo_customers.customer_last_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.customerfilter}}",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_last_name",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "maxLength": 65535,
                    "primary": false,
                    "nullable": false,
                    "name": "customer_last_name"
                  }
                },
                "operation": "LIKE"
              },
              {
                "id": "servo_customers.customer_phone_number",
                "field": "servo_customers.customer_phone_number",
                "type": "double",
                "operator": "less_or_equal",
                "value": "{{$_GET.customerfilter}}",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_phone_number",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "primary": false,
                    "nullable": false,
                    "name": "customer_phone_number"
                  }
                },
                "operation": "<="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_customers",
              "column": "customer_first_name",
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
              "name": "customer_id"
            },
            {
              "type": "text",
              "name": "customer_first_name"
            },
            {
              "type": "text",
              "name": "customer_last_name"
            },
            {
              "type": "number",
              "name": "customer_phone_number"
            },
            {
              "type": "text",
              "name": "customer_picture"
            },
            {
              "type": "text",
              "name": "customer_class"
            },
            {
              "type": "text",
              "name": "customer_sex"
            },
            {
              "type": "datetime",
              "name": "customer_dob"
            },
            {
              "type": "number",
              "name": "customer_age"
            },
            {
              "type": "text",
              "name": "customer_address"
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