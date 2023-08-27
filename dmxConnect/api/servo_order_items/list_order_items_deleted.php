<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "order_id"
      },
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
      "name": "list_order_items_deleted",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_order_item_deletes",
              "column": "time_deleted"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_order_item_deletes",
              "column": "order_item_delete_id"
            },
            {
              "table": "servo_order_item_deletes",
              "column": "deleted_item_quantity"
            },
            {
              "table": "servo_order_item_deletes",
              "column": "deleted_order_item_id"
            }
          ],
          "table": {
            "name": "servo_order_item_deletes"
          },
          "primary": "order_item_delete_id",
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
                      "table": "servo_order_item_deletes",
                      "column": "deleted_product_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_item_deletes",
                      "column": "user_deleted"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT servo_products.product_name, servo_order_item_deletes.time_deleted, servo_user.user_username, servo_order_item_deletes.order_item_delete_id, servo_order_item_deletes.deleted_item_quantity, servo_order_item_deletes.deleted_order_item_id\nFROM servo_order_item_deletes\nINNER JOIN servo_products ON servo_products.product_id = servo_order_item_deletes.deleted_product_id INNER JOIN servo_user ON servo_user.user_id = servo_order_item_deletes.user_deleted\nWHERE servo_order_item_deletes.order_id = :P1 /* {{$_GET.order_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.order_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_order_item_deletes.order_id",
                "field": "servo_order_item_deletes.order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.order_id}}",
                "data": {
                  "table": "servo_order_item_deletes",
                  "column": "order_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "name": "order_id"
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
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "datetime",
          "name": "time_deleted"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "order_item_delete_id"
        },
        {
          "type": "number",
          "name": "deleted_item_quantity"
        },
        {
          "type": "number",
          "name": "deleted_order_item_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>