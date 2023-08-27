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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_customers",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customers"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_customers\nWHERE customer_class = 'special'\nORDER BY customer_first_name ASC",
          "params": [],
          "primary": "customer_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customers.customer_class",
                "field": "servo_customers.customer_class",
                "type": "string",
                "operator": "equal",
                "value": "special",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_class",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "maxLength": 65535,
                    "primary": false,
                    "nullable": true,
                    "name": "customer_class"
                  }
                },
                "operation": "="
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
      ],
      "outputType": "array",
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>