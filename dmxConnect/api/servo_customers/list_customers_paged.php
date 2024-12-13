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
        "name": "customerfilter"
      },
      {
        "type": "text",
        "name": "customerfilter2"
      },
      {
        "type": "text",
        "name": "customer_id"
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
          "query": "select * from `servo_customers` where `servo_customers`.`customer_first_name` like ? and `servo_customers`.`customer_last_name` like ? order by `customer_id` DESC limit ? offset ?",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customerfilter}}",
              "test": ""
            },
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.customerfilter2}}",
              "test": ""
            }
          ],
          "primary": "customer_id",
          "wheres": {
            "condition": "AND",
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
                "operation": "LIKE",
                "table": "servo_customers"
              },
              {
                "id": "servo_customers.customer_last_name",
                "field": "servo_customers.customer_last_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.customerfilter2}}",
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
                "operation": "LIKE",
                "table": "servo_customers"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_customers",
              "column": "customer_id",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "limitTest": "23",
          "offsetTest": "1"
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
              "type": "text",
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
            },
            {
              "type": "text",
              "name": "id_card_number"
            },
            {
              "type": "text",
              "name": "location_lat"
            },
            {
              "type": "text",
              "name": "locatio_lon"
            },
            {
              "type": "number",
              "name": "customer_city"
            },
            {
              "type": "text",
              "name": "customer_building_photo"
            },
            {
              "type": "text",
              "name": "customer_location_diretions"
            },
            {
              "type": "number",
              "name": "customer_nationality"
            },
            {
              "type": "text",
              "name": "customer_email"
            },
            {
              "type": "text",
              "name": "customer_legal_status"
            },
            {
              "type": "text",
              "name": "customer_tax_payer_number"
            },
            {
              "type": "text",
              "name": "customer_rep_name"
            },
            {
              "type": "text",
              "name": "customer_rep_surname"
            },
            {
              "type": "text",
              "name": "customer_rep_id_card"
            },
            {
              "type": "text",
              "name": "customer_rep_address"
            },
            {
              "type": "text",
              "name": "customer_rep_phone"
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