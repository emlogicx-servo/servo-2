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
        "name": "product_group_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_product_groups_items",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_product_group_items",
              "column": "product_group_item_id"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_id"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_quantity"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_group_id"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_product_unit_price"
            },
            {
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_product_group_items",
              "column": "product_group_item_type"
            }
          ],
          "table": {
            "name": "servo_product_group_items",
            "alias": "servo_product_group_items"
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
                      "table": "servo_product_group_items",
                      "column": "product_group_product_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_id"
            }
          ],
          "query": "SELECT servo_product_group_items.product_group_item_id, servo_product_group_items.product_group_product_id, servo_product_group_items.product_group_product_quantity, servo_product_group_items.product_group_product_group_id, servo_product_group_items.product_group_product_unit_price, servo_products.product_name, servo_product_group_items.product_group_item_type\nFROM servo_product_group_items AS servo_product_group_items\nINNER JOIN servo_products AS servo_products ON (servo_products.product_id = servo_product_group_items.product_group_product_id)\nWHERE servo_product_group_items.product_group_product_group_id = :P1 /* {{$_GET.product_group_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_group_id}}"
            }
          ],
          "primary": "product_group_item_id",
          "orders": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_group_items.product_group_product_group_id",
                "field": "servo_product_group_items.product_group_product_group_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_group_id}}",
                "data": {
                  "table": "servo_product_group_items",
                  "column": "product_group_product_group_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": false,
                    "references": "product_group_id",
                    "inTable": "servo_product_groups",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "product_group_product_group_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_group_item_id"
        },
        {
          "type": "number",
          "name": "product_group_product_id"
        },
        {
          "type": "number",
          "name": "product_group_product_quantity"
        },
        {
          "type": "number",
          "name": "product_group_product_group_id"
        },
        {
          "type": "number",
          "name": "product_group_product_unit_price"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "text",
          "name": "product_group_item_type"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>