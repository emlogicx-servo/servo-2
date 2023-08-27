<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
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
        "name": "user"
      },
      {
        "type": "text",
        "name": "service"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "product_methods_report",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select SUM(transaction_amount) as TotalPayments, payment_method_name as Method from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\nleft join servo_services on (service_id = servo_service_service_id)\n\nwhere order_time >= ? and order_time <= ? and servo_user_user_id like ? and servo_service_service_id like ?\n\ngroup by servo_payment_methods.payment_method_name",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2022-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2022-05-05 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.service}}",
                "test": "%"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "order_item_id",
            "type": "number"
          },
          {
            "name": "order_time_ordered",
            "type": "text"
          },
          {
            "name": "order_time_ready",
            "type": "text"
          },
          {
            "name": "order_time_delivered",
            "type": "text"
          },
          {
            "name": "order_item_status",
            "type": "text"
          },
          {
            "name": "servo_orders_order_id",
            "type": "number"
          },
          {
            "name": "servo_products_product_id",
            "type": "number"
          },
          {
            "name": "servo_user_user_prepared_id",
            "type": "number"
          },
          {
            "name": "order_item_notes",
            "type": "text"
          },
          {
            "name": "order_item_quantity",
            "type": "text"
          },
          {
            "name": "order_item_price",
            "type": "text"
          },
          {
            "name": "order_item_discount",
            "type": "text"
          },
          {
            "name": "order_time_processing",
            "type": "text"
          },
          {
            "name": "order_item_type",
            "type": "text"
          },
          {
            "name": "servo_users_user_ordered",
            "type": "number"
          },
          {
            "name": "order_item_group_type",
            "type": "text"
          },
          {
            "name": "servo_departments_department_id",
            "type": "text"
          },
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
            "type": "text"
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
            "name": "servo_service_service_id",
            "type": "number"
          },
          {
            "name": "coverage_percentage",
            "type": "number"
          },
          {
            "name": "coverage_partner",
            "type": "text"
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
            "name": "payment_method_id",
            "type": "number"
          },
          {
            "name": "payment_method_name",
            "type": "text"
          },
          {
            "name": "service_id",
            "type": "number"
          },
          {
            "name": "service_name",
            "type": "text"
          },
          {
            "name": "servo_service_sales_point",
            "type": "number"
          },
          {
            "name": "SUM(order_item_quantity)",
            "type": "text"
          },
          {
            "name": "sum(order_item_quantity * order_item_price)",
            "type": "text"
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "payment_methods_report_",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select SUM(transaction_amount) as TotalPayments, payment_method_name as Method from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\nleft join servo_services on (service_id = servo_service_service_id)\n\nwhere transaction_type = 'Settlement' and order_time >= ? and order_time <= ? and servo_user_user_id like ? and servo_service_service_id like ?\n\ngroup by servo_payment_methods.payment_method_name",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2022-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2022-11-11 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.service}}",
                "test": "%"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "TotalPayments",
            "type": "text"
          },
          {
            "name": "Method",
            "type": "text"
          }
        ],
        "disabled": true
      }
    ]
  }
}
JSON
);
?>