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
    "steps": {
      "name": "product_category_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_category_name, SUM(order_item_quantity) as Volume, sum(order_item_quantity * order_item_price) as Total from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nwhere order_status in ('Paid', 'Credit') AND servo_user_user_id LIKE :P3 and order_time >= :P1 and order_time <= :P2 and servo_service_service_id LIKE :P4  \n\ngroup by product_category_name",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.datefrom}}",
              "test": "2022-04-01 01:43:08"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.dateto}}",
              "test": "2022-08-20 01:43:08"
            },
            {
              "name": ":P3",
              "value": "{{$_GET.user}}",
              "test": "%"
            },
            {
              "name": ":P4",
              "value": "{{$_GET.service}}",
              "test": "%"
            }
          ]
        }
      },
      "output": true,
      "meta": [
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