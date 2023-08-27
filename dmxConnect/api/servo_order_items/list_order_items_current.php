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
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_order_items",
            "alias": "servo_order_items"
          },
          "joins": [
            {
              "table": "servo_products",
              "column": "*",
              "alias": "servo_products",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_products_product_id"
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
              "alias": "servo_user",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_users_user_ordered"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_orders",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_orders",
                    "column": "order_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_orders_order_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "order_id"
            },
            {
              "table": "servo_product_groups",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_product_groups",
                    "column": "product_group_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_order_items",
                      "column": "order_item_group_id"
                    }
                  }
                ]
              },
              "primary": "product_group_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_order_items.servo_orders_order_id",
                "field": "servo_order_items.servo_orders_order_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.order_id}}",
                "data": {
                  "table": "servo_order_items",
                  "column": "servo_orders_order_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "order_id",
                    "inTable": "servo_orders",
                    "referenceType": "integer",
                    "onUpdate": "NO ACTION",
                    "onDelete": "NO ACTION",
                    "name": "servo_orders_order_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "select * from `servo_order_items` as `servo_order_items` left join `servo_products` as `servo_products` on `servo_products`.`product_id` = `servo_order_items`.`servo_products_product_id` left join `servo_user` as `servo_user` on `servo_user`.`user_id` = `servo_order_items`.`servo_users_user_ordered` left join `servo_orders` on `servo_orders`.`order_id` = `servo_order_items`.`servo_orders_order_id` left join `servo_product_groups` on `servo_product_groups`.`product_group_id` = `servo_order_items`.`order_item_group_id` where `servo_order_items`.`servo_orders_order_id` = ? order by `servo_order_items`.`order_time_ordered` DESC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.order_id}}",
              "test": ""
            }
          ],
          "orders": [
            {
              "table": "servo_order_items",
              "column": "order_time_ordered",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "primary": "order_item_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "order_item_id"
        },
        {
          "type": "datetime",
          "name": "order_time_ordered"
        },
        {
          "type": "datetime",
          "name": "order_time_ready"
        },
        {
          "type": "datetime",
          "name": "order_time_delivered"
        },
        {
          "type": "text",
          "name": "order_item_status"
        },
        {
          "type": "number",
          "name": "servo_orders_order_id"
        },
        {
          "type": "number",
          "name": "servo_products_product_id"
        },
        {
          "type": "number",
          "name": "servo_user_user_prepared_id"
        },
        {
          "type": "text",
          "name": "order_item_notes"
        },
        {
          "type": "number",
          "name": "order_item_quantity"
        },
        {
          "type": "number",
          "name": "order_item_price"
        },
        {
          "type": "number",
          "name": "order_item_discount"
        },
        {
          "type": "datetime",
          "name": "order_time_processing"
        },
        {
          "type": "text",
          "name": "order_item_type"
        },
        {
          "type": "number",
          "name": "servo_users_user_ordered"
        },
        {
          "type": "text",
          "name": "order_item_group_type"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
        },
        {
          "type": "number",
          "name": "order_item_group_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>