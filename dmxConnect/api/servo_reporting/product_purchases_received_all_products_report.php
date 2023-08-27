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
        "name": "department"
      },
      {
        "type": "text",
        "name": "user"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_purchases_received_all_products_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_name, product_category_name, sum(po_item_quantity) as Volume, sum(po_item_quantity * po_item_price) as Total\n\nfrom servo_products\n\nleft JOIN \nservo_purchase_order_items on servo_purchase_order_items.po_product_id = servo_products.product_id\n\nleft join \nservo_purchase_orders on (servo_purchase_order_items.po_id = servo_purchase_orders.po_id)\n\nleft JOIN\nservo_product_categories on servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id\n\nWHERE \nservo_purchase_orders.servo_users_user_ordered_id LIKE ?\nand time_ordered between ? and ?\nAND po_status = 'Received'\nand servo_departments_department_id like ?\n\ngroup by product_name",
          "params": [
            {
              "name": "?",
              "value": "{{$_GET.user}}",
              "test": "%"
            },
            {
              "name": "?",
              "value": "{{$_GET.datefrom}}",
              "test": "2022-03-10 00:00"
            },
            {
              "name": "?",
              "value": "{{$_GET.dateto}}",
              "test": "2022-05-10 00:00"
            },
            {
              "name": "?",
              "value": "{{$_GET.department}}",
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
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>