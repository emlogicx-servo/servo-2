<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "po_id"
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
                "table": "servo_purchase_orders",
                "column": "po_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_vendors_vendor_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_users_user_ordered_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_users_user_approved_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_users_user_received_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_ordered"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_approved"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_received"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_status"
              },
              {
                "table": "servo_purchase_orders",
                "column": "payment_method"
              },
              {
                "table": "servo_purchase_orders",
                "column": "payment_status"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_notes"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_departments_department_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_need_by_date"
              },
              {
                "table": "servo_purchase_orders",
                "column": "transfer_source_department_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_type"
              },
              {
                "table": "servo_vendors",
                "column": "vendor_name"
              },
              {
                "table": "servo_vendors",
                "column": "vendor_address"
              },
              {
                "table": "servo_vendors",
                "column": "vendor_phone_number"
              },
              {
                "table": "source_dept",
                "column": "department_name",
                "alias": "department_source"
              },
              {
                "table": "dest_dept",
                "column": "department_name",
                "alias": "department_destination"
              },
              {
                "table": "user_ordered",
                "column": "user_fname",
                "alias": "ordered_fname"
              },
              {
                "table": "user_ordered",
                "column": "user_lname",
                "alias": "ordered_lname"
              },
              {
                "table": "user_ordered",
                "column": "user_username",
                "alias": "ordered_username"
              },
              {
                "table": "user_ordered",
                "column": "user_fname",
                "alias": "approved_fname"
              },
              {
                "table": "user_ordered",
                "column": "user_lname",
                "alias": "approved_lname"
              },
              {
                "table": "user_ordered",
                "column": "user_username",
                "alias": "approved_username"
              }
            ],
            "table": {
              "name": "servo_purchase_orders",
              "alias": "servo_purchase_orders"
            },
            "joins": [
              {
                "table": "servo_vendors",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_vendors",
                      "column": "vendor_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_vendors_vendor_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "vendor_id"
              },
              {
                "table": "servo_department",
                "column": "*",
                "alias": "source_dept",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "source_dept",
                      "column": "department_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "transfer_source_department_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "department_id"
              },
              {
                "table": "servo_department",
                "column": "*",
                "alias": "dest_dept",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "dest_dept",
                      "column": "department_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_departments_department_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "department_id"
              },
              {
                "table": "servo_user",
                "column": "*",
                "alias": "user_ordered",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "user_ordered",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_users_user_ordered_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              },
              {
                "table": "servo_user",
                "column": "*",
                "alias": "user_approved",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "user_approved",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_users_user_received_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              },
              {
                "table": "servo_user",
                "column": "*",
                "alias": "user_received",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "user_received",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_users_user_received_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_purchase_orders.po_id",
                  "field": "servo_purchase_orders.po_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.po_id}}",
                  "data": {
                    "table": "servo_purchase_orders",
                    "column": "po_id",
                    "type": "number"
                  },
                  "operation": "=",
                  "table": "servo_purchase_orders"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT servo_purchase_orders.po_id, servo_purchase_orders.servo_vendors_vendor_id, servo_purchase_orders.servo_users_user_ordered_id, servo_purchase_orders.servo_users_user_approved_id, servo_purchase_orders.servo_users_user_received_id, servo_purchase_orders.time_ordered, servo_purchase_orders.time_approved, servo_purchase_orders.time_received, servo_purchase_orders.po_status, servo_purchase_orders.payment_method, servo_purchase_orders.payment_status, servo_purchase_orders.po_notes, servo_purchase_orders.servo_departments_department_id, servo_purchase_orders.po_need_by_date, servo_purchase_orders.transfer_source_department_id, servo_purchase_orders.po_type, servo_vendors.vendor_name, servo_vendors.vendor_address, servo_vendors.vendor_phone_number, source_dept.department_name AS department_source, dest_dept.department_name AS department_destination, user_ordered.user_fname AS ordered_fname, user_ordered.user_lname AS ordered_lname, user_ordered.user_username AS ordered_username, user_ordered.user_fname AS approved_fname, user_ordered.user_lname AS approved_lname, user_ordered.user_username AS approved_username\nFROM servo_purchase_orders AS servo_purchase_orders\nLEFT JOIN servo_vendors ON servo_vendors.vendor_id = servo_purchase_orders.servo_vendors_vendor_id LEFT JOIN servo_department AS source_dept ON source_dept.department_id = servo_purchase_orders.transfer_source_department_id LEFT JOIN servo_department AS dest_dept ON dest_dept.department_id = servo_purchase_orders.servo_departments_department_id LEFT JOIN servo_user AS user_ordered ON user_ordered.user_id = servo_purchase_orders.servo_users_user_ordered_id LEFT JOIN servo_user AS user_approved ON user_approved.user_id = servo_purchase_orders.servo_users_user_received_id LEFT JOIN servo_user AS user_received ON user_received.user_id = servo_purchase_orders.servo_users_user_received_id\nWHERE servo_purchase_orders.po_id = :P1 /* {{$_GET.po_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.po_id}}",
                "test": "5"
              }
            ],
            "primary": "po_id"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "po_id"
          },
          {
            "type": "number",
            "name": "servo_vendors_vendor_id"
          },
          {
            "type": "number",
            "name": "servo_users_user_ordered_id"
          },
          {
            "type": "number",
            "name": "servo_users_user_approved_id"
          },
          {
            "type": "number",
            "name": "servo_users_user_received_id"
          },
          {
            "type": "datetime",
            "name": "time_ordered"
          },
          {
            "type": "datetime",
            "name": "time_approved"
          },
          {
            "type": "datetime",
            "name": "time_received"
          },
          {
            "type": "text",
            "name": "po_status"
          },
          {
            "type": "number",
            "name": "payment_method"
          },
          {
            "type": "text",
            "name": "payment_status"
          },
          {
            "type": "text",
            "name": "po_notes"
          },
          {
            "type": "number",
            "name": "servo_departments_department_id"
          },
          {
            "type": "datetime",
            "name": "po_need_by_date"
          },
          {
            "type": "number",
            "name": "transfer_source_department_id"
          },
          {
            "type": "text",
            "name": "po_type"
          },
          {
            "type": "text",
            "name": "vendor_name"
          },
          {
            "type": "text",
            "name": "vendor_address"
          },
          {
            "type": "number",
            "name": "vendor_phone_number"
          },
          {
            "type": "text",
            "name": "department_source"
          },
          {
            "type": "text",
            "name": "department_destination"
          },
          {
            "type": "text",
            "name": "ordered_fname"
          },
          {
            "type": "text",
            "name": "ordered_lname"
          },
          {
            "type": "text",
            "name": "ordered_username"
          },
          {
            "type": "text",
            "name": "approved_fname"
          },
          {
            "type": "text",
            "name": "approved_lname"
          },
          {
            "type": "text",
            "name": "approved_username"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "read_po_totals",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select \n(select (sum((po_item_price * po_item_quantity) * ((100 - po_discount)/100))) from servo_purchase_order_items inner join servo_purchase_orders on (servo_purchase_orders.po_id = servo_purchase_order_items.po_id) where servo_purchase_orders.po_id = :P1) as 'POTotal',\n\n(select sum(transaction_amount) from servo_vendor_cash_transaction where transaction_order = :P1) as 'POTotalPaid'\n\n\n",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.po_id}}",
                "test": "35"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "POTotal",
            "type": "text"
          },
          {
            "name": "POTotalPaid",
            "type": "text"
          }
        ]
      },
      {
        "name": "list_po_transactions",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [
              {
                "table": "servo_vendor_cash_transaction",
                "column": "vendor_transaction_id"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_amount"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_type"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "user_approved_id"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_date"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_payment_method"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_status"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_note"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_order"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_balance"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_amount_tendered"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_user_received"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_department_received"
              },
              {
                "table": "servo_vendor_cash_transaction",
                "column": "transaction_vendor_id"
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
                "table": "servo_payment_methods",
                "column": "payment_method_name"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.po_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_vendor_cash_transaction"
            },
            "primary": "vendor_transaction_id",
            "joins": [
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
                        "table": "servo_vendor_cash_transaction",
                        "column": "user_approved_id"
                      }
                    }
                  ]
                },
                "primary": "user_id"
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
                        "table": "servo_vendor_cash_transaction",
                        "column": "transaction_payment_method"
                      }
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
                  "id": "servo_vendor_cash_transaction.transaction_order",
                  "field": "servo_vendor_cash_transaction.transaction_order",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.po_id}}",
                  "data": {
                    "table": "servo_vendor_cash_transaction",
                    "column": "transaction_order",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "primary": false,
                      "nullable": true,
                      "name": "transaction_order"
                    }
                  },
                  "operation": "=",
                  "table": "servo_vendor_cash_transaction"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "orders": [
              {
                "table": "servo_vendor_cash_transaction",
                "column": "vendor_transaction_id",
                "direction": "DESC"
              }
            ],
            "query": "select `servo_vendor_cash_transaction`.`vendor_transaction_id`, `servo_vendor_cash_transaction`.`transaction_amount`, `servo_vendor_cash_transaction`.`transaction_type`, `servo_vendor_cash_transaction`.`user_approved_id`, `servo_vendor_cash_transaction`.`transaction_date`, `servo_vendor_cash_transaction`.`transaction_payment_method`, `servo_vendor_cash_transaction`.`transaction_status`, `servo_vendor_cash_transaction`.`transaction_note`, `servo_vendor_cash_transaction`.`transaction_order`, `servo_vendor_cash_transaction`.`transaction_balance`, `servo_vendor_cash_transaction`.`transaction_amount_tendered`, `servo_vendor_cash_transaction`.`transaction_user_received`, `servo_vendor_cash_transaction`.`transaction_department_received`, `servo_vendor_cash_transaction`.`transaction_vendor_id`, `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_payment_methods`.`payment_method_name` from `servo_vendor_cash_transaction` left join `servo_user` on `servo_user`.`user_id` = `servo_vendor_cash_transaction`.`user_approved_id` left join `servo_payment_methods` on `servo_payment_methods`.`payment_method_id` = `servo_vendor_cash_transaction`.`transaction_payment_method` where `servo_vendor_cash_transaction`.`transaction_order` = ? order by `servo_vendor_cash_transaction`.`vendor_transaction_id` DESC"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "vendor_transaction_id"
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
            "name": "transaction_status"
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
            "type": "number",
            "name": "transaction_user_received"
          },
          {
            "type": "number",
            "name": "transaction_department_received"
          },
          {
            "type": "number",
            "name": "transaction_vendor_id"
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
            "type": "text",
            "name": "payment_method_name"
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