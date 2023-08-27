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
      "name": "product_purchases_received_all_payment_methods_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select payment_method_id, payment_method_name, sum(po_item_quantity * po_item_price) as Total\n\nfrom servo_purchase_orders\n\nleft JOIN \nservo_purchase_order_items on servo_purchase_order_items.po_id = servo_purchase_orders.pO_id\n\nleft JOIN servo_payment_methods on servo_payment_methods.payment_method_id = servo_purchase_orders.payment_method\n\nWHERE \nservo_purchase_orders.servo_users_user_ordered_id LIKE ?\nand time_ordered between ? and ?\nAND po_status = 'Received'\nand servo_departments_department_id like ?\n\ngroup by payment_method",
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
          "name": "payment_method_id",
          "type": "text"
        },
        {
          "name": "payment_method_name",
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