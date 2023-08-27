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
        "name": "department_id"
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
            "name": "servo_product_price"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_price.product_price_department_id",
                "field": "servo_product_price.product_price_department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department_id}}",
                "data": {
                  "table": "servo_product_price",
                  "column": "product_price_department_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_product_price\nWHERE product_price_department_id = :P1 /* {{$_GET.department_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.department_id}}"
            }
          ]
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
          "name": "product_price_department_id"
        },
        {
          "type": "text",
          "name": "product_department"
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