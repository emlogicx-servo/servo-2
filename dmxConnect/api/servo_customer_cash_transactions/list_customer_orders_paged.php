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
    "steps": [
      {
        "name": "query_list_customer_orders",
        "module": "dbconnector",
        "action": "paged",
        "options": {
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
                "column": "order_status"
              },
              {
                "table": "servo_orders",
                "column": "order_discount"
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
                "table": "servo_orders",
                "column": "servo_shift_shift_id"
              },
              {
                "table": "servo_orders",
                "column": "servo_users_cashier_id"
              },
              {
                "table": "servo_orders",
                "column": "coverage_percentage"
              },
              {
                "table": "servo_orders",
                "column": "servo_service_service_id"
              },
              {
                "table": "servo_orders",
                "column": "coverage_partner"
              },
              {
                "table": "servo_orders",
                "column": "coverage_payment_status"
              },
              {
                "table": "servo_customer_table",
                "column": "table_id"
              },
              {
                "table": "servo_customer_table",
                "column": "table_name"
              },
              {
                "table": "servo_user",
                "column": "user_id"
              },
              {
                "table": "servo_user",
                "column": "user_fname"
              },
              {
                "table": "servo_user",
                "column": "user_lname"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_user",
                "column": "servo_user_departments_department_id"
              },
              {
                "table": "servo_services",
                "column": "service_id"
              },
              {
                "table": "servo_services",
                "column": "service_name"
              },
              {
                "table": "servo_payment_methods",
                "column": "payment_method_id"
              },
              {
                "table": "servo_payment_methods",
                "column": "payment_method_name"
              }
            ],
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
                  "id": "servo_orders.order_customer",
                  "field": "servo_orders.order_customer",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.customer_id}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "order_customer",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "customer_id",
                      "inTable": "servo_customers",
                      "onUpdate": "NO ACTION",
                      "onDelete": "NO ACTION",
                      "name": "order_customer"
                    }
                  },
                  "operation": "=",
                  "table": "servo_orders"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select `servo_orders`.`order_id`, `servo_orders`.`order_time`, `servo_orders`.`order_status`, `servo_orders`.`order_discount`, `servo_orders`.`servo_user_user_id`, `servo_orders`.`servo_customer_table_table_id`, `servo_orders`.`order_notes`, `servo_orders`.`servo_shift_shift_id`, `servo_orders`.`servo_users_cashier_id`, `servo_orders`.`coverage_percentage`, `servo_orders`.`servo_service_service_id`, `servo_orders`.`coverage_partner`, `servo_orders`.`coverage_payment_status`, `servo_customer_table`.`table_id`, `servo_customer_table`.`table_name`, `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_user`.`servo_user_departments_department_id`, `servo_services`.`service_id`, `servo_services`.`service_name`, `servo_payment_methods`.`payment_method_id`, `servo_payment_methods`.`payment_method_name` from `servo_orders` as `servo_orders` left join `servo_customer_table` as `servo_customer_table` on `servo_customer_table`.`table_id` = `servo_orders`.`servo_customer_table_table_id` left join `servo_user` as `servo_user` on `servo_user`.`user_id` = `servo_orders`.`servo_user_user_id` left join `servo_services` as `servo_services` on `servo_services`.`service_id` = `servo_orders`.`servo_service_service_id` left join `servo_payment_methods` on `servo_payment_methods`.`payment_method_id` = `servo_orders`.`servo_payment_methods_payment_method` where `servo_orders`.`order_customer` = ? order by `servo_orders`.`order_id` DESC",
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
                "type": "text",
                "name": "order_status"
              },
              {
                "type": "number",
                "name": "order_discount"
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
                "name": "servo_users_cashier_id"
              },
              {
                "type": "number",
                "name": "coverage_percentage"
              },
              {
                "type": "number",
                "name": "servo_service_service_id"
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
                "type": "number",
                "name": "table_id"
              },
              {
                "type": "text",
                "name": "table_name"
              },
              {
                "type": "number",
                "name": "user_id"
              },
              {
                "type": "text",
                "name": "user_fname"
              },
              {
                "type": "text",
                "name": "user_lname"
              },
              {
                "type": "text",
                "name": "user_username"
              },
              {
                "type": "number",
                "name": "servo_user_departments_department_id"
              },
              {
                "type": "number",
                "name": "service_id"
              },
              {
                "type": "text",
                "name": "service_name"
              },
              {
                "type": "number",
                "name": "payment_method_id"
              },
              {
                "type": "text",
                "name": "payment_method_name"
              }
            ]
          }
        ],
        "outputType": "object",
        "type": "dbconnector_paged_select"
      },
      {
        "name": "customer_order_stats",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select\n(select COUNT(order_id)\nFROM servo_orders\nWHERE order_customer = :P1 /* {{$_GET.customer_id}} */ AND order_status = 'Ordered') as Ordered,\n\n(select COUNT(order_id)\nFROM servo_orders\nWHERE order_customer = :P1 /* {{$_GET.customer_id}} */ AND order_status = 'Paid') as Paid,\n\n(select COUNT(order_id)\nFROM servo_orders\nWHERE order_customer = :P1 /* {{$_GET.customer_id}} */ AND order_status = 'Pending') as Pending\n\nfrom servo_orders where order_customer = :P1\ngroup by order_customer",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.customer_id}}",
                "test": "7424"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "Ordered",
            "type": "text"
          },
          {
            "name": "Paid",
            "type": "text"
          },
          {
            "name": "Pending",
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