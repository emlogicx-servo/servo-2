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
      "name": "product_purchases_received_all_time_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select *, sum(po_item_quantity * po_item_price) as Total\nfrom servo_purchase_orders\n\nleft join \nservo_purchase_order_items on (servo_purchase_order_items.po_id = servo_purchase_orders.po_id)\n\nWHERE \nservo_purchase_orders.servo_users_user_ordered_id LIKE ?\nand time_ordered between ? and ?\nAND po_status = 'Received'\nand servo_departments_department_id like ?\n\ngroup by time_received\n",
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
          "name": "po_id",
          "type": "number"
        },
        {
          "name": "servo_vendors_vendor_id",
          "type": "text"
        },
        {
          "name": "servo_users_user_ordered_id",
          "type": "number"
        },
        {
          "name": "servo_users_user_approved_id",
          "type": "number"
        },
        {
          "name": "servo_users_user_received_id",
          "type": "number"
        },
        {
          "name": "time_ordered",
          "type": "text"
        },
        {
          "name": "time_approved",
          "type": "text"
        },
        {
          "name": "time_received",
          "type": "text"
        },
        {
          "name": "po_status",
          "type": "text"
        },
        {
          "name": "payment_method",
          "type": "text"
        },
        {
          "name": "payment_status",
          "type": "text"
        },
        {
          "name": "po_notes",
          "type": "text"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "po_need_by_date",
          "type": "text"
        },
        {
          "name": "po_product_id",
          "type": "number"
        },
        {
          "name": "po_item_quantity",
          "type": "number"
        },
        {
          "name": "po_item_price",
          "type": "number"
        },
        {
          "name": "po_item_notes",
          "type": "text"
        },
        {
          "name": "po_item_id",
          "type": "number"
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