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
        "name": "current_shift"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_2",
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
                "table": "servo_orders",
                "column": "order_time"
              },
              {
                "table": "servo_orders",
                "column": "order_customer"
              },
              {
                "table": "servo_orders",
                "column": "order_discount"
              },
              {
                "table": "servo_orders",
                "column": "order_status"
              },
              {
                "table": "servo_orders",
                "column": "servo_user_user_id"
              },
              {
                "table": "servo_orders",
                "column": "servo_customer_table_table_id"
              },
              {
                "table": "servo_orders",
                "column": "order_notes"
              },
              {
                "table": "servo_customer_table",
                "column": "table_name"
              },
              {
                "table": "order_service",
                "column": "user_username"
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
                "table": "order_closer",
                "column": "user_username",
                "alias": "order_closer"
              }
            ],
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
                "table": "servo_user",
                "column": "*",
                "alias": "order_service",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "order_service",
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
                      "value": {
                        "table": "servo_orders",
                        "column": "order_customer"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "customer_id"
              },
              {
                "table": "servo_user",
                "column": "*",
                "alias": "order_closer",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "order_closer",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_orders",
                        "column": "servo_users_cashier_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              }
            ],
            "query": "SELECT servo_orders.order_id, servo_orders.order_time, servo_orders.order_customer, servo_orders.order_discount, servo_orders.order_status, servo_orders.servo_user_user_id, servo_orders.servo_customer_table_table_id, servo_orders.order_notes, servo_customer_table.table_name, order_service.user_username, servo_customers.customer_first_name, servo_customers.customer_last_name, order_closer.user_username AS order_closer\nFROM servo_orders\nLEFT JOIN servo_customer_table ON servo_customer_table.table_id = servo_orders.servo_customer_table_table_id LEFT JOIN servo_user AS order_service ON order_service.user_id = servo_orders.servo_user_user_id LEFT JOIN servo_customers ON servo_customers.customer_id = servo_orders.order_customer LEFT JOIN servo_user AS order_closer ON order_closer.user_id = servo_orders.servo_users_cashier_id\nWHERE servo_orders.servo_shift_shift_id = :P1 /* {{$_GET.current_shift}} */ AND servo_orders.order_status <> 'Credit'\nORDER BY servo_orders.order_id DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.current_shift}}"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
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
                }
              ],
              "conditional": null,
              "valid": true
            },
            "orders": [
              {
                "table": "servo_orders",
                "column": "order_id",
                "direction": "DESC",
                "recid": 1
              }
            ],
            "primary": "order_id"
          }
        },
        "output": true,
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
            "type": "text",
            "name": "table_name"
          },
          {
            "type": "text",
            "name": "user_username"
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
            "name": "order_closer"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "query",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT servo_orders.order_id, servo_orders.order_extra_info, servo_orders.order_time, servo_orders.order_customer, servo_orders.order_discount, servo_orders.order_status, servo_orders.servo_user_user_id, servo_orders.servo_customer_table_table_id, servo_orders.order_notes, servo_customer_table.table_name, order_service.user_username, servo_customers.customer_first_name, servo_customers.customer_last_name, order_closer.user_username AS order_closer, (select SUM(transaction_amount) from servo_customer_cash_transaction where transaction_order = order_id) as TotalPaid\nFROM servo_orders\nLEFT JOIN servo_customer_table ON servo_customer_table.table_id = servo_orders.servo_customer_table_table_id LEFT JOIN servo_user AS order_service ON order_service.user_id = servo_orders.servo_user_user_id LEFT JOIN servo_customers ON servo_customers.customer_id = servo_orders.order_customer LEFT JOIN servo_user AS order_closer ON order_closer.user_id = servo_orders.servo_users_cashier_id LEFT JOIN servo_customer_cash_transaction ON servo_customer_cash_transaction.transaction_order = servo_orders.order_id\nWHERE servo_orders.servo_shift_shift_id = :P1 /* {{$_GET.current_shift}} */ AND servo_orders.order_status <> 'Credit'\nGROUP BY servo_orders.order_id, servo_orders.order_time, servo_orders.order_customer, servo_orders.order_discount, servo_orders.order_status, servo_orders.servo_user_user_id, servo_orders.servo_customer_table_table_id, servo_orders.order_notes, servo_customer_table.table_name, order_service.user_username, servo_customers.customer_first_name, servo_customers.customer_last_name, order_closer.user_username\nORDER BY servo_orders.order_id DESC",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.current_shift}}",
                "test": "36"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "order_id",
            "type": "number"
          },
          {
            "name": "order_extra_info",
            "type": "file"
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
            "type": "file"
          },
          {
            "name": "table_name",
            "type": "text"
          },
          {
            "name": "user_username",
            "type": "text"
          },
          {
            "name": "customer_first_name",
            "type": "file"
          },
          {
            "name": "customer_last_name",
            "type": "file"
          },
          {
            "name": "order_closer",
            "type": "text"
          },
          {
            "name": "TotalPaid",
            "type": "text"
          }
        ],
        "type": "dbcustom_query"
      }
    ]
  }
}
JSON
);
?>