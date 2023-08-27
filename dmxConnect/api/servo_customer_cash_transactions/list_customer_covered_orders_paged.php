<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "customer_id"
      },
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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_customer_covered_orders",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_orders",
            "alias": "servo_orders"
          },
          "primary": "order_id",
          "joins": [
            {
              "table": "servo_customer_table",
              "column": "*",
              "alias": "servo_customer_table",
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
                      "table": "servo_orders",
                      "column": "servo_user_user_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_services",
              "column": "*",
              "alias": "servo_services",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_services",
                    "column": "service_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_service_service_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "service_id"
            },
            {
              "table": "servo_payment_methods",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_payment_methods",
                    "column": "payment_method_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_payment_methods_payment_method"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "payment_method_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_orders.coverage_partner",
                "field": "servo_orders.coverage_partner",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer_id}}",
                "data": {
                  "table": "servo_orders",
                  "column": "coverage_partner",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "customer_id",
                    "inTable": "servo_customers",
                    "referenceType": "integer",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "coverage_partner"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_orders AS servo_orders\nLEFT JOIN servo_customer_table AS servo_customer_table ON servo_customer_table.table_id = servo_orders.servo_customer_table_table_id LEFT JOIN servo_user AS servo_user ON servo_user.user_id = servo_orders.servo_user_user_id LEFT JOIN servo_services AS servo_services ON servo_services.service_id = servo_orders.servo_service_service_id LEFT JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_orders.servo_payment_methods_payment_method\nWHERE servo_orders.coverage_partner = :P1 /* {{$_GET.customer_id}} */\nORDER BY servo_orders.order_id DESC, servo_orders.order_time DESC, servo_orders.order_status ASC, servo_orders.servo_shift_shift_id ASC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_id}}"
            }
          ],
          "orders": [
            {
              "table": "servo_orders",
              "column": "order_id",
              "direction": "DESC"
            },
            {
              "table": "servo_orders",
              "column": "order_time",
              "direction": "DESC"
            },
            {
              "table": "servo_orders",
              "column": "order_status",
              "direction": "ASC"
            },
            {
              "table": "servo_orders",
              "column": "servo_shift_shift_id",
              "direction": "ASC"
            }
          ]
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
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
          ]
        }
      ],
      "outputType": "object",
      "type": "dbconnector_paged_select"
    }
  }
}
JSON
);
?>