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
      },
      {
        "type": "text",
        "name": "po_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_purchases_received",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_id, product_name, po_item_quantity, sum(po_item_price * po_item_quantity)\nfrom servo_purchase_order_items\n\nleft JOIN\nservo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\n\ninner JOIN\nservo_products on product_id = po_product_id\n\n\nWHERE \nservo_purchase_orders.servo_users_user_received_id LIKE ?\nand time_ordered between ? and ?\nand servo_departments_department_id like ?\nand po_status LIKE ?\n\ngroup by product_id\n\n",
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
              "test": "2023-10-10 00:00"
            },
            {
              "name": "?",
              "value": "{{$_GET.department}}",
              "test": "%"
            },
            {
              "name": "?",
              "value": "{{$_GET.po_status}}",
              "test": "%"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "product_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "po_item_quantity",
          "type": "text"
        },
        {
          "name": "sum(po_item_price * po_item_quantity)",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>