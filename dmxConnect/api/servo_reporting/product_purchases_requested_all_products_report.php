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
      "name": "product_purchases_requested_all_products_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select sum(po_item_quantity * po_item_price) as TOTAL, SUM(po_item_quantity) as QUANTITY\nfrom servo_purchase_order_items\n\nleft join \nservo_purchase_orders on (servo_purchase_order_items.po_id = servo_purchase_orders.po_id)\n\nWHERE \nservo_purchase_orders.servo_users_user_ordered_id LIKE ?\nand time_ordered between ? and ?\nAND po_status = 'Requested'\nand servo_departments_department_id like ?",
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
          "name": "TOTAL",
          "type": "text"
        },
        {
          "name": "QUANTITY",
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