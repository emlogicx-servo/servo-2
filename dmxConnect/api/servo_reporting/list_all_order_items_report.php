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
        "name": "datefrom"
      },
      {
        "type": "text",
        "name": "dateto"
      },
      {
        "type": "text",
        "name": "waiter"
      },
      {
        "type": "text",
        "name": "order"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_all_order_items",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_orders",
              "column": "order_id"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_shifts",
              "column": "shift_id"
            },
            {
              "table": "servo_products",
              "column": "product_name",
              "aggregate": ""
            },
            {
              "table": "servo_order_items",
              "column": "order_item_quantity"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_price"
            },
            {
              "table": "servo_product_categories",
              "column": "product_category_name"
            }
          ],
          "table": {
            "name": "servo_orders"
          },
          "joins": [
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
                      "table": "servo_orders",
                      "column": "servo_user_user_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_customer_table",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customer_table",
                    "column": "table_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_customer_table_table_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_shifts",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_shifts",
                    "column": "servo_branches_branch_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_customer_table",
                      "column": "servo_branches_branch_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_order_items",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_order_items",
                    "column": "servo_orders_order_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "order_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
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
                      "table": "servo_order_items",
                      "column": "servo_products_product_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_product_categories",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_product_categories",
                    "column": "product_categories_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_products",
                      "column": "servo_product_category_product_category_id"
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT servo_orders.order_id, servo_user.user_username, servo_shifts.shift_id, servo_products.product_name, servo_order_items.order_item_quantity, servo_order_items.order_item_price, servo_product_categories.product_category_name\nFROM servo_orders\nINNER JOIN servo_user ON (servo_user.user_id = servo_orders.servo_user_user_id) INNER JOIN servo_customer_table ON (servo_customer_table.table_id = servo_orders.servo_customer_table_table_id) INNER JOIN servo_shifts ON (servo_shifts.servo_branches_branch_id = servo_customer_table.servo_branches_branch_id) INNER JOIN servo_order_items ON (servo_order_items.servo_orders_order_id = servo_orders.order_id) INNER JOIN servo_products ON (servo_products.product_id = servo_order_items.servo_products_product_id) INNER JOIN servo_product_categories ON (servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id)\nWHERE servo_orders.order_time >= :P1 /* {{$_GET.datefrom}} */ AND servo_orders.order_time <= :P2 /* {{$_GET.dateto}} */ AND (servo_user.user_id = :P3 /* {{$_GET.waiter}} */)\nORDER BY servo_orders.order_time DESC",
          "params": [
            {
              "operator": "greater_or_equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.datefrom}}"
            },
            {
              "operator": "less_or_equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.dateto}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.waiter}}"
            }
          ],
          "orders": [
            {
              "table": "servo_orders",
              "column": "order_time",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_orders.order_time",
                "field": "servo_orders.order_time",
                "type": "datetime",
                "operator": "greater_or_equal",
                "value": "{{$_GET.datefrom}}",
                "data": {
                  "table": "servo_orders",
                  "column": "order_time",
                  "type": "datetime"
                },
                "operation": ">="
              },
              {
                "id": "servo_orders.order_time",
                "field": "servo_orders.order_time",
                "type": "datetime",
                "operator": "less_or_equal",
                "value": "{{$_GET.dateto}}",
                "data": {
                  "table": "servo_orders",
                  "column": "order_time",
                  "type": "datetime"
                },
                "operation": "<="
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_user.user_id",
                    "field": "servo_user.user_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.waiter}}",
                    "data": {
                      "table": "servo_user",
                      "column": "user_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.waiter}}"
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
          "name": "order_id"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "shift_id"
        },
        {
          "type": "text",
          "name": "product_name"
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
          "type": "text",
          "name": "product_category_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>