<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "date_start"
      },
      {
        "type": "text",
        "name": "date_end"
      },
      {
        "type": "text",
        "name": "product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_product_sale_single",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select *, SUM(order_item_quantity * order_item_price) as AMOUNT, sum(order_item_quantity) as Total\n\nfrom servo_order_items\n\nleft join\nservo_products on (servo_products.product_id = servo_order_items.servo_products_product_id)\n\nleft join \nservo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nWHERE servo_order_items.order_time_ordered between ? and ?\nand product_id = :P2\nand order_status = 'Paid' or 'Credit'\ngroup by servo_order_items.order_item_price",
          "params": [
            {
              "name": "?",
              "value": "{{$_GET.date_start}}",
              "test": "2022-04-01 01:43:08"
            },
            {
              "name": "?",
              "value": "{{$_GET.date_end}}",
              "test": "2022-05-04 01:43:08"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.product_id}}",
              "test": "68"
            }
          ]
        }
      },
      "output": true,
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
          "type": "number"
        },
        {
          "name": "order_item_price",
          "type": "number"
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
          "name": "product_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "product_picture",
          "type": "text"
        },
        {
          "name": "servo_product_brands_product_brand_id",
          "type": "number"
        },
        {
          "name": "product_description",
          "type": "text"
        },
        {
          "name": "servo_product_category_product_category_id",
          "type": "number"
        },
        {
          "name": "product_standard_price",
          "type": "number"
        },
        {
          "name": "product_discount",
          "type": "number"
        },
        {
          "name": "product_type",
          "type": "text"
        },
        {
          "name": "product_stock_value",
          "type": "text"
        },
        {
          "name": "product_min_stock",
          "type": "number"
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
          "name": "AMOUNT",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>