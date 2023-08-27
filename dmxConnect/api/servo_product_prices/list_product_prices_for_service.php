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
        "name": "service_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_price",
            "alias": "servo_product_price"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_price AS servo_product_price\nWHERE servo_service_service_id = :P1 /* {{$_GET.service_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.service_id}}"
            }
          ],
          "primary": "product_price_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_price.servo_service_service_id",
                "field": "servo_product_price.servo_service_service_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.service_id}}",
                "data": {
                  "table": "servo_product_price",
                  "column": "servo_service_service_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "service_id",
                    "inTable": "servo_services",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "servo_service_service_id"
                  }
                },
                "operation": "="
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
          "type": "number",
          "name": "product_price_id"
        },
        {
          "type": "number",
          "name": "product_price"
        },
        {
          "type": "datetime",
          "name": "product_price_date"
        },
        {
          "type": "number",
          "name": "product_price_product_id"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "text",
          "name": "product_price_code"
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