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
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_product_price",
              "column": "product_price"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_id"
            }
          ],
          "table": {
            "name": "servo_product_price"
          },
          "joins": [
            {
              "table": "servo_products",
              "column": "*",
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
              }
            },
            {
              "table": "servo_department",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_department",
                    "column": "department_id",
                    "operator": "equal",
                    "value": {
                      "table": "",
                      "column": ""
                    },
                    "operation": "="
                  },
                  {
                    "table": "servo_department",
                    "column": "department_name",
                    "operator": "equal",
                    "value": {
                      "table": "",
                      "column": ""
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT servo_product_price.product_price, servo_product_price.product_price_id\nFROM servo_product_price\nINNER JOIN servo_products ON (servo_products.product_id = servo_product_price.product_price_product_id) INNER JOIN servo_department ON (servo_department.department_id = \"\" AND servo_department.department_name = \"\")",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_price_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>