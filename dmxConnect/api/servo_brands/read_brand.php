<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "brand_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_product_brands",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_brands"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_product_brands\nWHERE product_brand_id = :P1 /* {{$_GET.brand_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.brand_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_brands.product_brand_id",
                "field": "servo_product_brands.product_brand_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.brand_id}}",
                "data": {
                  "table": "servo_product_brands",
                  "column": "product_brand_id",
                  "type": "number"
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
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>