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
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_list_customer_cash_transactions",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_amount",
                "alias": "TotalPaymentsShift",
                "aggregate": "SUM"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "customer_transaction_id"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_amount"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_type"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "user_approved_id"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_date"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_payment_method"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_note"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_order"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_balance"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_amount_tendered"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_orders",
                "column": "servo_shift_shift_id"
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
                "column": "customer_id"
              },
              {
                "table": "servo_payment_methods",
                "column": "payment_method_name"
              }
            ],
            "table": {
              "name": "servo_customer_cash_transaction",
              "alias": "servo_customer_cash_transaction"
            },
            "primary": "customer_transaction_id",
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
                      "value": {
                        "table": "servo_customer_cash_transaction",
                        "column": "transaction_order"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "order_id"
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
                        "table": "servo_customer_cash_transaction",
                        "column": "user_approved_id"
                      }
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
                      "operation": "=",
                      "value": {
                        "table": "servo_customer_cash_transaction",
                        "column": "customer_id"
                      }
                    }
                  ]
                },
                "primary": "customer_id"
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
                      "operation": "=",
                      "value": {
                        "table": "servo_customer_cash_transaction",
                        "column": "transaction_payment_method"
                      }
                    }
                  ]
                },
                "primary": "payment_method_id"
              }
            ],
            "query": "select sum(`servo_customer_cash_transaction`.`transaction_amount`) as `TotalPaymentsShift`, `servo_customer_cash_transaction`.`customer_transaction_id`, `servo_customer_cash_transaction`.`transaction_amount`, `servo_customer_cash_transaction`.`transaction_type`, `servo_customer_cash_transaction`.`user_approved_id`, `servo_customer_cash_transaction`.`transaction_date`, `servo_customer_cash_transaction`.`transaction_payment_method`, `servo_customer_cash_transaction`.`transaction_note`, `servo_customer_cash_transaction`.`transaction_order`, `servo_customer_cash_transaction`.`transaction_balance`, `servo_customer_cash_transaction`.`transaction_amount_tendered`, `servo_user`.`user_username`, `servo_orders`.`servo_shift_shift_id`, `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_customers`.`customer_id`, `servo_payment_methods`.`payment_method_name` from `servo_customer_cash_transaction` as `servo_customer_cash_transaction` left join `servo_orders` on `servo_orders`.`order_id` = `servo_customer_cash_transaction`.`transaction_order` left join `servo_user` on `servo_user`.`user_id` = `servo_customer_cash_transaction`.`user_approved_id` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_customer_cash_transaction`.`customer_id` left join `servo_payment_methods` on `servo_payment_methods`.`payment_method_id` = `servo_customer_cash_transaction`.`transaction_payment_method` where `servo_orders`.`servo_shift_shift_id` = ? group by `servo_customer_cash_transaction`.`customer_transaction_id`, `servo_customer_cash_transaction`.`transaction_amount`, `servo_customer_cash_transaction`.`transaction_type`, `servo_customer_cash_transaction`.`user_approved_id`, `servo_customer_cash_transaction`.`transaction_date`, `servo_customer_cash_transaction`.`transaction_payment_method`, `servo_customer_cash_transaction`.`transaction_note`, `servo_customer_cash_transaction`.`transaction_order`, `servo_customer_cash_transaction`.`transaction_balance`, `servo_customer_cash_transaction`.`transaction_amount_tendered`, `servo_user`.`user_username`, `servo_orders`.`servo_shift_shift_id`, `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_customers`.`customer_id`, `servo_payment_methods`.`payment_method_name` order by `servo_customer_cash_transaction`.`transaction_date` DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.shift_id}}",
                "test": "36"
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
                  "value": "{{$_GET.shift_id}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "servo_shift_shift_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "shift_id",
                      "inTable": "servo_shifts",
                      "referenceType": "integer",
                      "onUpdate": "NO ACTION",
                      "onDelete": "NO ACTION",
                      "name": "servo_shift_shift_id"
                    }
                  },
                  "operation": "=",
                  "table": "servo_customer_cash_transaction"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "groupBy": [
              {
                "table": "servo_customer_cash_transaction",
                "column": "customer_transaction_id"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_amount"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_type"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "user_approved_id"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_date"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_payment_method"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_note"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_order"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_balance"
              },
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_amount_tendered"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_orders",
                "column": "servo_shift_shift_id"
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
                "column": "customer_id"
              },
              {
                "table": "servo_payment_methods",
                "column": "payment_method_name"
              }
            ],
            "orders": [
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_date",
                "direction": "DESC",
                "recid": 1
              }
            ]
          },
          "connection": "servodb"
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "TotalPaymentsShift"
          },
          {
            "type": "number",
            "name": "customer_transaction_id"
          },
          {
            "type": "number",
            "name": "transaction_amount"
          },
          {
            "type": "text",
            "name": "transaction_type"
          },
          {
            "type": "number",
            "name": "user_approved_id"
          },
          {
            "type": "datetime",
            "name": "transaction_date"
          },
          {
            "type": "number",
            "name": "transaction_payment_method"
          },
          {
            "type": "text",
            "name": "transaction_note"
          },
          {
            "type": "number",
            "name": "transaction_order"
          },
          {
            "type": "number",
            "name": "transaction_balance"
          },
          {
            "type": "number",
            "name": "transaction_amount_tendered"
          },
          {
            "type": "text",
            "name": "user_username"
          },
          {
            "type": "number",
            "name": "servo_shift_shift_id"
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
            "type": "number",
            "name": "customer_id"
          },
          {
            "type": "text",
            "name": "payment_method_name"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "TotalPaymentShift",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_customer_cash_transaction",
                "column": "transaction_amount",
                "alias": "TotalPaymentsShift",
                "aggregate": "SUM"
              }
            ],
            "table": {
              "name": "servo_customer_cash_transaction",
              "alias": "servo_customer_cash_transaction"
            },
            "primary": "customer_transaction_id",
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
                      "value": {
                        "table": "servo_customer_cash_transaction",
                        "column": "transaction_order"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "order_id"
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
                        "table": "servo_customer_cash_transaction",
                        "column": "user_approved_id"
                      }
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
                      "operation": "=",
                      "value": {
                        "table": "servo_orders",
                        "column": "coverage_partner"
                      }
                    }
                  ]
                },
                "primary": "customer_id"
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
                      "operation": "=",
                      "value": {
                        "table": "servo_orders",
                        "column": "servo_payment_methods_payment_method"
                      }
                    }
                  ]
                },
                "primary": "payment_method_id"
              }
            ],
            "query": "select sum(`servo_customer_cash_transaction`.`transaction_amount`) as `TotalPaymentsShift` from `servo_customer_cash_transaction` as `servo_customer_cash_transaction` left join `servo_orders` on `servo_orders`.`order_id` = `servo_customer_cash_transaction`.`transaction_order` left join `servo_user` on `servo_user`.`user_id` = `servo_customer_cash_transaction`.`user_approved_id` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_orders`.`coverage_partner` left join `servo_payment_methods` on `servo_payment_methods`.`payment_method_id` = `servo_orders`.`servo_payment_methods_payment_method` where `servo_orders`.`servo_shift_shift_id` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.shift_id}}",
                "test": "36"
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
                  "value": "{{$_GET.shift_id}}",
                  "data": {
                    "table": "servo_orders",
                    "column": "servo_shift_shift_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "shift_id",
                      "inTable": "servo_shifts",
                      "referenceType": "integer",
                      "onUpdate": "NO ACTION",
                      "onDelete": "NO ACTION",
                      "name": "servo_shift_shift_id"
                    }
                  },
                  "operation": "=",
                  "table": "servo_customer_cash_transaction"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "groupBy": [],
            "orders": []
          },
          "connection": "servodb"
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "TotalPaymentsShift"
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