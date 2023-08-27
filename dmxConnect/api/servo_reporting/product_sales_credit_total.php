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
        "name": "service"
      },
      {
        "type": "text",
        "name": "user"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_product_sale_credit_total",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select SUM(order_item_quantity * order_item_price) as AMOUNT, SUM(order_item_quantity) as QUANTITY\n\nfrom servo_order_items\n\nleft join \nservo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nWHERE servo_user_user_id LIKE ? \nand order_time_ordered >= ? and order_time_ordered <= ?\nand servo_service_service_id LIKE ?\nand order_status = 'Credit'\n",
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
          "name": "AMOUNT",
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