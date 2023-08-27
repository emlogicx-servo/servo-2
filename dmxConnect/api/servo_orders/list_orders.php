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
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "current_shift"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "servo_orders"
            },
            "joins": [
              {
                "table": "servo_customer_table",
                "column": "*",
                "type": "LEFT",
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
                },
                "primary": "table_id"
              },
              {
                "table": "servo_order_items",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_order_items",
                      "column": "servo_departments_department_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_orders",
                        "column": "servo_departments_department_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "order_item_id"
              }
            ],
            "query": "SELECT *\nFROM servo_orders\nLEFT JOIN servo_customer_table ON (servo_customer_table.table_id = servo_orders.servo_customer_table_table_id) LEFT JOIN servo_order_items ON (servo_order_items.servo_departments_department_id = servo_orders.servo_departments_department_id)\nWHERE servo_orders.servo_user_user_id = :P1 /* {{$_GET.user_id}} */ AND servo_orders.servo_shift_shift_id = :P2 /* {{$_GET.current_shift}} */ AND servo_orders.order_status <> 'Credit' AND servo_orders.order_status <> 'Adjustment'\nORDER BY servo_orders.order_id DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.user_id}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.current_shift}}"
              }
            ],
            "dir": "",
            "sort": "",
            "orders": [
              {
                "table": "servo_orders",
                "column": "order_id",
                "direction": "DESC",
                "recid": 1
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_orders.servo_user_user_id",
                  "field": "servo_orders.servo_user_user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.user_id}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "servo_user_user_id",
                    "type": "number"
                  },
                  "operation": "="
                },
                {
                  "id": "servo_orders.servo_shift_shift_id",
                  "field": "servo_orders.servo_shift_shift_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.current_shift}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "servo_shift_shift_id",
                    "type": "number"
                  },
                  "operation": "="
                },
                {
                  "id": "servo_orders.order_status",
                  "field": "servo_orders.order_status",
                  "type": "string",
                  "operator": "not_equal",
                  "value": "Credit",
                  "data": {
                    "table": "servo_orders",
                    "column": "order_status",
                    "type": "text"
                  },
                  "operation": "<>"
                },
                {
                  "id": "servo_orders.order_status",
                  "field": "servo_orders.order_status",
                  "type": "string",
                  "operator": "not_equal",
                  "value": "Adjustment",
                  "data": {
                    "table": "servo_orders",
                    "column": "order_status",
                    "type": "text"
                  },
                  "operation": "<>"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "primary": "order_id"
          }
        },
        "meta": [
          {
            "type": "number",
            "name": "order_id"
          },
          {
            "type": "datetime",
            "name": "order_time"
          },
          {
            "type": "number",
            "name": "order_customer"
          },
          {
            "type": "number",
            "name": "order_discount"
          },
          {
            "type": "text",
            "name": "order_status"
          },
          {
            "type": "number",
            "name": "servo_user_user_id"
          },
          {
            "type": "number",
            "name": "servo_customer_table_table_id"
          },
          {
            "type": "text",
            "name": "order_notes"
          },
          {
            "type": "number",
            "name": "servo_shift_shift_id"
          },
          {
            "type": "number",
            "name": "order_amount_tendered"
          },
          {
            "type": "number",
            "name": "order_balance"
          },
          {
            "type": "number",
            "name": "servo_users_cashier_id"
          },
          {
            "type": "number",
            "name": "servo_payment_methods_payment_method"
          },
          {
            "type": "number",
            "name": "servo_departments_department_id"
          },
          {
            "type": "number",
            "name": "servo_service_service_id"
          },
          {
            "type": "number",
            "name": "coverage_percentage"
          },
          {
            "type": "number",
            "name": "coverage_partner"
          },
          {
            "type": "text",
            "name": "coverage_payment_status"
          },
          {
            "type": "datetime",
            "name": "order_time_paid"
          },
          {
            "type": "text",
            "name": "order_extra_info"
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query}}",
          "outputFields": [],
          "exec": {
            "steps": {
              "name": "custom",
              "module": "dbupdater",
              "action": "custom",
              "options": {
                "connection": "servodb",
                "sql": {
                  "query": "select sum(order_item_quantity * order_item_price) AS OrderTotal from servo_order_items  where servo_orders_order_id = :P1\ngroup by servo_orders_order_id",
                  "params": [
                    {
                      "name": ":P1",
                      "value": "{{order_id}}",
                      "test": "1231"
                    }
                  ]
                }
              },
              "output": true,
              "meta": [
                {
                  "name": "OrderTotal",
                  "type": "text"
                }
              ],
              "outputType": "array"
            }
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "order_id",
            "type": "number"
          },
          {
            "name": "order_time",
            "type": "datetime"
          },
          {
            "name": "order_customer",
            "type": "number"
          },
          {
            "name": "order_discount",
            "type": "number"
          },
          {
            "name": "order_status",
            "type": "text"
          },
          {
            "name": "servo_user_user_id",
            "type": "number"
          },
          {
            "name": "servo_customer_table_table_id",
            "type": "number"
          },
          {
            "name": "order_notes",
            "type": "text"
          },
          {
            "name": "servo_shift_shift_id",
            "type": "number"
          },
          {
            "name": "order_amount_tendered",
            "type": "number"
          },
          {
            "name": "order_balance",
            "type": "number"
          },
          {
            "name": "servo_users_cashier_id",
            "type": "number"
          },
          {
            "name": "servo_payment_methods_payment_method",
            "type": "number"
          },
          {
            "name": "servo_departments_department_id",
            "type": "number"
          },
          {
            "name": "servo_service_service_id",
            "type": "number"
          },
          {
            "name": "coverage_percentage",
            "type": "number"
          },
          {
            "name": "coverage_partner",
            "type": "number"
          },
          {
            "name": "coverage_payment_status",
            "type": "text"
          },
          {
            "name": "order_time_paid",
            "type": "datetime"
          },
          {
            "name": "order_extra_info",
            "type": "text"
          },
          {
            "name": "custom",
            "type": "array",
            "sub": [
              {
                "name": "OrderTotal",
                "type": "text"
              }
            ]
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>