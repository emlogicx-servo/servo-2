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
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "single",
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
                "table": "servo_customer_table",
                "column": "table_name"
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
                "column": "order_amount_tendered"
              },
              {
                "table": "servo_orders",
                "column": "order_balance"
              },
              {
                "table": "servo_orders",
                "column": "servo_users_cashier_id"
              },
              {
                "table": "servo_orders",
                "column": "servo_payment_methods_payment_method"
              },
              {
                "table": "servo_orders",
                "column": "servo_departments_department_id"
              },
              {
                "table": "servo_orders",
                "column": "servo_service_service_id"
              },
              {
                "table": "servo_orders",
                "column": "coverage_percentage"
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
                "table": "servo_orders",
                "column": "order_time_paid"
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
                "table": "servo_user",
                "column": "user_profile"
              },
              {
                "table": "servo_customers",
                "column": "customer_id"
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
                "table": "servo_customers",
                "column": "customer_phone_number"
              },
              {
                "table": "servo_customers",
                "column": "customer_picture"
              },
              {
                "table": "servo_customers",
                "column": "customer_class"
              },
              {
                "table": "servo_customers",
                "column": "customer_sex"
              },
              {
                "table": "servo_customers",
                "column": "customer_dob"
              },
              {
                "table": "servo_customers",
                "column": "customer_age"
              },
              {
                "table": "servo_customers",
                "column": "customer_address"
              },
              {
                "table": "servo_orders",
                "column": "order_extra_info"
              },
              {
                "table": "servo_orders",
                "column": "order_total_adjustment"
              }
            ],
            "table": {
              "name": "servo_orders",
              "alias": "servo_orders"
            },
            "joins": [
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
                      "operation": "=",
                      "value": {
                        "table": "servo_orders",
                        "column": "servo_user_user_id"
                      }
                    }
                  ]
                },
                "primary": "user_id"
              },
              {
                "table": "servo_customers",
                "column": "*",
                "alias": "servo_customers",
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
                      "operation": "=",
                      "value": {
                        "table": "servo_orders",
                        "column": "servo_customer_table_table_id"
                      }
                    }
                  ]
                },
                "primary": "table_id"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_orders.order_id",
                  "field": "servo_orders.order_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.order_id}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "order_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select `servo_orders`.`order_id`, `servo_orders`.`order_time`, `servo_orders`.`order_customer`, `servo_orders`.`order_discount`, `servo_orders`.`order_status`, `servo_orders`.`servo_user_user_id`, `servo_orders`.`servo_customer_table_table_id`, `servo_customer_table`.`table_name`, `servo_orders`.`order_notes`, `servo_orders`.`servo_shift_shift_id`, `servo_orders`.`order_amount_tendered`, `servo_orders`.`order_balance`, `servo_orders`.`servo_users_cashier_id`, `servo_orders`.`servo_payment_methods_payment_method`, `servo_orders`.`servo_departments_department_id`, `servo_orders`.`servo_service_service_id`, `servo_orders`.`coverage_percentage`, `servo_orders`.`coverage_partner`, `servo_orders`.`coverage_payment_status`, `servo_orders`.`order_time_paid`, `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_user`.`servo_user_departments_department_id`, `servo_user`.`user_profile`, `servo_customers`.`customer_id`, `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_customers`.`customer_phone_number`, `servo_customers`.`customer_picture`, `servo_customers`.`customer_class`, `servo_customers`.`customer_sex`, `servo_customers`.`customer_dob`, `servo_customers`.`customer_age`, `servo_customers`.`customer_address`, `servo_orders`.`order_extra_info`, `servo_orders`.`order_total_adjustment` from `servo_orders` as `servo_orders` left join `servo_user` as `servo_user` on `servo_user`.`user_id` = `servo_orders`.`servo_user_user_id` left join `servo_customers` as `servo_customers` on `servo_customers`.`customer_id` = `servo_orders`.`order_customer` left join `servo_customer_table` on `servo_customer_table`.`table_id` = `servo_orders`.`servo_customer_table_table_id` where `servo_orders`.`order_id` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.order_id}}",
                "test": "1"
              }
            ],
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
            "name": "table_name"
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
            "type": "text",
            "name": "user_profile"
          },
          {
            "type": "number",
            "name": "customer_id"
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
            "name": "customer_phone_number"
          },
          {
            "type": "text",
            "name": "customer_picture"
          },
          {
            "type": "text",
            "name": "customer_class"
          },
          {
            "type": "text",
            "name": "customer_sex"
          },
          {
            "type": "datetime",
            "name": "customer_dob"
          },
          {
            "type": "number",
            "name": "customer_age"
          },
          {
            "type": "text",
            "name": "customer_address"
          },
          {
            "type": "text",
            "name": "order_extra_info"
          },
          {
            "type": "number",
            "name": "order_total_adjustment"
          }
        ],
        "outputType": "object",
        "output": true
      },
      {
        "name": "query",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select distinct *, (select customer_first_name from servo_customers where  servo_orders.order_customer = servo_customers.customer_id) as 'CustomerFirstName', (select customer_last_name from servo_customers where  servo_orders.order_customer = servo_customers.customer_id) as 'CustomerLastName', (select customer_first_name from servo_customers where  servo_orders.coverage_partner = servo_customers.customer_id) as 'CoverageFirstName', (select customer_last_name from servo_customers where  servo_orders.coverage_partner = servo_customers.customer_id) as 'CoverageLastName' from servo_orders\ninner join servo_user on servo_orders.servo_user_user_id = servo_user.user_id\ninner join servo_customers on servo_orders.order_customer = servo_customers.customer_id\n\nwhere order_id = :P1",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.order_id}}",
                "test": "1190"
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
            "name": "order_time",
            "type": "text"
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
            "type": "text"
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
            "type": "text"
          },
          {
            "name": "order_balance",
            "type": "text"
          },
          {
            "name": "servo_users_cashier_id",
            "type": "text"
          },
          {
            "name": "servo_payment_methods_payment_method",
            "type": "number"
          },
          {
            "name": "servo_departments_department_id",
            "type": "text"
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
            "type": "text"
          },
          {
            "name": "user_id",
            "type": "number"
          },
          {
            "name": "user_fname",
            "type": "text"
          },
          {
            "name": "user_lname",
            "type": "text"
          },
          {
            "name": "user_username",
            "type": "text"
          },
          {
            "name": "password",
            "type": "text"
          },
          {
            "name": "servo_user_departments_department_id",
            "type": "number"
          },
          {
            "name": "user_profile",
            "type": "text"
          },
          {
            "name": "customer_id",
            "type": "number"
          },
          {
            "name": "customer_first_name",
            "type": "text"
          },
          {
            "name": "customer_last_name",
            "type": "text"
          },
          {
            "name": "customer_phone_number",
            "type": "text"
          },
          {
            "name": "customer_picture",
            "type": "text"
          },
          {
            "name": "customer_class",
            "type": "text"
          },
          {
            "name": "customer_sex",
            "type": "text"
          },
          {
            "name": "customer_dob",
            "type": "text"
          },
          {
            "name": "customer_age",
            "type": "number"
          },
          {
            "name": "customer_address",
            "type": "text"
          },
          {
            "name": "CustomerFirstName",
            "type": "text"
          },
          {
            "name": "CustomerLastName",
            "type": "text"
          },
          {
            "name": "CoverageFirstName",
            "type": "text"
          },
          {
            "name": "CoverageLastName",
            "type": "text"
          }
        ],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "order_coverage_customer",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_customers",
                "column": "customer_first_name"
              },
              {
                "table": "servo_customers",
                "column": "customer_last_name"
              },
              {
                "table": "servo_customers",
                "column": "customer_phone_number"
              },
              {
                "table": "servo_customers",
                "column": "customer_address"
              }
            ],
            "table": {
              "name": "servo_orders"
            },
            "primary": "order_id",
            "joins": [
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
                  "value": "{{query.order_customer}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "order_customer",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "nullable": true,
                      "name": "order_customer"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT servo_customers.customer_first_name, servo_customers.customer_last_name, servo_customers.customer_phone_number, servo_customers.customer_address\nFROM servo_orders\nLEFT JOIN servo_customers ON (servo_customers.customer_id = servo_orders.order_customer)\nWHERE servo_orders.order_customer = :P1 /* {{query.order_customer}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{query.order_customer}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
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
            "name": "customer_phone_number"
          },
          {
            "type": "text",
            "name": "customer_address"
          }
        ],
        "outputType": "object",
        "type": "dbconnector_single"
      },
      {
        "name": "order_coverage_partner",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_customers",
                "column": "customer_first_name"
              },
              {
                "table": "servo_customers",
                "column": "customer_last_name"
              },
              {
                "table": "servo_customers",
                "column": "customer_phone_number"
              },
              {
                "table": "servo_customers",
                "column": "customer_address"
              }
            ],
            "table": {
              "name": "servo_orders"
            },
            "primary": "order_id",
            "joins": [
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
                  "value": "{{query.coverage_partner}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "order_customer",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "nullable": true,
                      "name": "order_customer"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_customers`.`customer_phone_number`, `servo_customers`.`customer_address` from `servo_orders` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_orders`.`order_customer` where `servo_orders`.`order_customer` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{query.coverage_partner}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
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
            "name": "customer_phone_number"
          },
          {
            "type": "text",
            "name": "customer_address"
          }
        ],
        "outputType": "object",
        "type": "dbconnector_single"
      }
    ]
  }
}
JSON
);
?>