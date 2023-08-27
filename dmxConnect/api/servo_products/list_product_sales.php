<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_id"
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
      "name": "query_list_product_sales",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "servo_order_items",
              "column": "order_item_id"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_ordered"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_ready"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_delivered"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_status"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_price"
            },
            {
              "table": "servo_orders",
              "column": "order_id"
            },
            {
              "table": "servo_orders",
              "column": "order_time"
            },
            {
              "table": "servo_orders",
              "column": "order_status"
            },
            {
              "table": "servo_orders",
              "column": "order_notes"
            },
            {
              "table": "servo_customers",
              "column": "customer_first_name"
            },
            {
              "table": "servo_customers",
              "column": "customer_last_name"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_id}}",
              "test": "41"
            }
          ],
          "table": {
            "name": "servo_order_items"
          },
          "primary": "order_item_id",
          "joins": [
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
                    "operation": "=",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_orders_order_id"
                    }
                  }
                ]
              },
              "primary": "order_id"
            },
            {
              "table": "servo_customers",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customers",
                    "column": "customer_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_orders",
                      "column": "order_customer"
                    }
                  }
                ]
              },
              "primary": "customer_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_user_user_id"
                    }
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "orders": [],
          "query": "select `servo_order_items`.`order_item_id`, `servo_order_items`.`order_time_ordered`, `servo_order_items`.`order_time_ready`, `servo_order_items`.`order_time_delivered`, `servo_order_items`.`order_item_status`, `servo_order_items`.`order_item_price`, `servo_orders`.`order_id`, `servo_orders`.`order_time`, `servo_orders`.`order_status`, `servo_orders`.`order_notes`, `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_user`.`user_username` from `servo_order_items` left join `servo_orders` on `servo_orders`.`order_id` = `servo_order_items`.`servo_orders_order_id` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_orders`.`order_customer` left join `servo_user` on `servo_user`.`user_id` = `servo_orders`.`servo_user_user_id` where `servo_order_items`.`servo_products_product_id` = ?",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_order_items.servo_products_product_id",
                "field": "servo_order_items.servo_products_product_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_id}}",
                "data": {
                  "table": "servo_order_items",
                  "column": "servo_products_product_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "product_id",
                    "inTable": "servo_products",
                    "referenceType": "integer",
                    "onUpdate": "NO ACTION",
                    "onDelete": "NO ACTION",
                    "name": "servo_products_product_id"
                  }
                },
                "operation": "=",
                "table": "servo_order_items"
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
          "name": "order_item_price"
        },
        {
          "type": "number",
          "name": "order_id"
        },
        {
          "type": "datetime",
          "name": "order_time"
        },
        {
          "type": "text",
          "name": "order_status"
        },
        {
          "type": "text",
          "name": "order_notes"
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
          "type": "text",
          "name": "user_username"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>