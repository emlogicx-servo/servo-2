<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "number",
        "name": "user"
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
        "name": "service"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "sales_report",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select product_name, product_id, customer_first_name, customer_last_name, customer_id, product_category_name, SUM(order_item_quantity) as Volume, sum(order_item_quantity * order_item_price) as Total from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_customers on customer_id = order_customer\n\nleft join servo_services on (servo_services.service_id = servo_orders.servo_service_service_id)\n\nwhere servo_user_user_id LIKE ? and order_time >= ? and order_time <= ? and service_id LIKE ? AND order_status != 'Adjustment'\n\ngroup by product_id\n",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2023-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2024-05-05 01:43:08"
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
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "product_id",
            "type": "number"
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
            "name": "customer_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          },
          {
            "name": "Volume",
            "type": "text"
          },
          {
            "name": "Total",
            "type": "text"
          }
        ]
      },
      {
        "name": "sales_report_categories",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select product_name, product_id, customer_first_name, customer_last_name, customer_id, product_category_name, product_categories_id, SUM(order_item_quantity) as Volume, sum(order_item_quantity * order_item_price) as Total from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_customers on customer_id = order_customer\n\nleft join servo_services on (servo_services.service_id = servo_orders.servo_service_service_id)\n\nwhere servo_user_user_id LIKE ? and order_time >= ? and order_time <= ? and service_id LIKE ? AND order_status != 'Adjustment'\n\ngroup by product_categories_id\n",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2023-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2024-05-05 01:43:08"
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
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "product_id",
            "type": "number"
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
            "name": "customer_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          },
          {
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "Volume",
            "type": "text"
          },
          {
            "name": "Total",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "sales_report_payments",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select SUM(transaction_amount) as TotalPayments, payment_method_name as Method from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\nleft join servo_services on (service_id = servo_service_service_id)\n\nwhere transaction_type = 'Settlement' and transaction_date >= ? and transaction_order <= ? \n\ngroup by servo_payment_methods.payment_method_name",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2022-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2024-05-05 01:43:08"
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
        ]
      },
      {
        "name": "sales_report_export_table",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select product_name, product_id, customer_first_name, customer_last_name, customer_id, product_category_name, SUM(order_item_quantity) as Volume, sum(order_item_quantity * order_item_price) as Total from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_customers on customer_id = order_customer\n\nleft join servo_services on (servo_services.service_id = servo_orders.servo_service_service_id)\n\nwhere servo_user_user_id LIKE ? and order_time >= ? and order_time <= ? and service_id LIKE ? AND order_status != 'Adjustment'\n\ngroup by customer_id\n",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "%"
              },
              {
                "name": "?",
                "value": "{{$_GET.datefrom}}",
                "test": "2022-04-01 01:43:08"
              },
              {
                "name": "?",
                "value": "{{$_GET.dateto}}",
                "test": "2024-05-05 01:43:08"
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
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "product_id",
            "type": "number"
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
            "name": "customer_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          },
          {
            "name": "Volume",
            "type": "text"
          },
          {
            "name": "Total",
            "type": "text"
          }
        ]
      }
    ]
  }
}
JSON
);
?>