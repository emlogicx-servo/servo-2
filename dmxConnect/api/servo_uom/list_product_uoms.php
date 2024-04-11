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
      "name": "list_product_uoms",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "select",
          "columns": [],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "servo_product_uom_multiples"
          },
          "primary": "uom_multiple_id",
          "joins": [],
          "query": "select * from `servo_product_uom_multiples` where `servo_product_uom_multiples`.`uom_product_id` = ?",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_uom_multiples.uom_product_id",
                "field": "servo_product_uom_multiples.uom_product_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_id}}",
                "data": {
                  "table": "servo_product_uom_multiples",
                  "column": "uom_product_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": false,
                    "references": "product_id",
                    "inTable": "servo_products",
                    "referenceType": "integer",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "uom_product_id"
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
          "name": "uom_multiple_id"
        },
        {
          "type": "number",
          "name": "uom_product_id"
        },
        {
          "type": "text",
          "name": "uom_name"
        },
        {
          "type": "number",
          "name": "uom_reference_multiple"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>