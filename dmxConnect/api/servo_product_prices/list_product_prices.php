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
        "name": "product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_product_prices",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_product_price",
              "column": "product_price_id"
            },
            {
              "table": "servo_product_price",
              "column": "product_price"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_date"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_product_id"
            },
            {
              "table": "servo_product_price",
              "column": "servo_service_service_id"
            },
            {
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_services",
              "column": "service_id"
            },
            {
              "table": "servo_services",
              "column": "service_name"
            }
          ],
          "table": {
            "name": "servo_product_price",
            "alias": "servo_product_price"
          },
          "joins": [
            {
              "table": "servo_products",
              "column": "*",
              "alias": "servo_products",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_product_price",
                      "column": "product_price_product_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_id"
            },
            {
              "table": "servo_services",
              "column": "*",
              "alias": "servo_services",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_services",
                    "column": "service_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_product_price",
                      "column": "servo_service_service_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "service_id"
            }
          ],
          "query": "SELECT servo_product_price.product_price_id, servo_product_price.product_price, servo_product_price.product_price_date, servo_product_price.product_price_product_id, servo_product_price.servo_service_service_id, servo_products.product_name, servo_services.service_id, servo_services.service_name\nFROM servo_product_price AS servo_product_price\nINNER JOIN servo_products AS servo_products ON (servo_products.product_id = servo_product_price.product_price_product_id) INNER JOIN servo_services AS servo_services ON (servo_services.service_id = servo_product_price.servo_service_service_id)\nWHERE servo_product_price.product_price_product_id = :P1 /* {{$_GET.product_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_id}}"
            }
          ],
          "orders": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_price.product_price_product_id",
                "field": "servo_product_price.product_price_product_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_id}}",
                "data": {
                  "table": "servo_product_price",
                  "column": "product_price_product_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "primary": "product_price_id"
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
          "name": "product_name"
        },
        {
          "type": "number",
          "name": "service_id"
        },
        {
          "type": "number",
          "name": "service_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>