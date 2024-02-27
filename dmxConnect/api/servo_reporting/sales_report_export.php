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
            "query": "select product_name, product_id, customer_first_name, customer_last_name, customer_id, product_category_name, SUM(order_item_quantity) as Volume, sum(order_item_quantity * order_item_price) as Total from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_customers on customer_id = order_customer\n\nleft join servo_services on (servo_services.service_id = servo_orders.servo_service_service_id)\n\nwhere servo_user_user_id LIKE ? and order_time >= ? and order_time <= ? and service_id LIKE ? AND order_status != 'Adjustment'\n\ngroup by customer_id\n",
            "params": [
              {
                "name": "?",
                "value": "{{$_GET.user}}",
                "test": "5"
              },
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
        "name": "salesReport",
        "module": "collections",
        "action": "filterColumns",
        "options": {
          "collection": "{{sales_report}}",
          "columns": [
            "product_name",
            "product_category_name",
            "Volume",
            "Total",
            "customer_first_name",
            "customer_last_name"
          ],
          "keep": true
        },
        "meta": [
          {
            "name": "product_id",
            "type": "number"
          },
          {
            "name": "customer_id",
            "type": "number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "fileExists",
        "module": "fs",
        "action": "exists",
        "options": {
          "path": "/reports/servoSalesReport.csv",
          "then": {
            "steps": [
              {
                "name": "fileDelete",
                "module": "fs",
                "action": "remove",
                "options": {
                  "path": "/reports/servoSalesReport.csv"
                },
                "outputType": "boolean",
                "output": true
              },
              {
                "name": "csvExport",
                "module": "export",
                "action": "csv",
                "options": {
                  "path": "/reports/servoSalesReporting.csv",
                  "data": "{{salesReport}}",
                  "header": true
                },
                "outputType": "text"
              }
            ]
          },
          "else": {
            "steps": {
              "name": "csvExport_copy",
              "module": "export",
              "action": "csv",
              "options": {
                "path": "/reports/servoSalesReporting.csv",
                "data": "{{salesReport}}",
                "header": true
              },
              "outputType": "text"
            }
          }
        },
        "outputType": "boolean",
        "output": true
      }
    ]
  }
}
JSON
);
?>