<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "shift"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_report_by_date",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select *, SUM(order_item_quantity), sum(order_item_quantity * order_item_price) from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nwhere servo_shift_shift_id = :P4 \n\ngroup by minute(order_time_ordered)\norder by order_time_ordered ASC\n",
          "params": [
            {
              "name": ":P4",
              "value": "{{$_GET.shift}}",
              "test": ""
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
          "type": "number"
        },
        {
          "name": "order_time_processing",
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
          "name": "product_price",
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
          "type": "number"
        },
        {
          "name": "product_categories_id",
          "type": "number"
        },
        {
          "name": "product_category_name",
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
          "name": "order_payment_method",
          "type": "text"
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
          "name": "SUM(order_item_quantity)",
          "type": "text"
        },
        {
          "name": "sum(order_item_quantity * order_item_price)",
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