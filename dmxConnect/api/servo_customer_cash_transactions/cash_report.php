<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "time_from"
      },
      {
        "type": "text",
        "name": "time_to"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "custom",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n((select (sum((order_item_price * order_item_quantity) * ((100 - order_discount)/100) * ((100 - coverage_percentage)/100))) from servo_order_items left join servo_orders on (order_id = servo_orders_order_id) where order_time > ? and order_time < ?) - \n\n(select sum(transaction_amount) from servo_customer_cash_transaction left join servo_orders on (order_id = transaction_order) where transaction_type = 'Settlement' and order_time > :P3 and order_time < :P4)\n\n)\n",
          "params": [
            {
              "name": "?",
              "value": "{{$_GET.time_from}}",
              "test": "2022-01-01 00:00"
            },
            {
              "name": "?",
              "value": "{{$_GET.time_to}}",
              "test": "2022-012-12 00:00"
            },
            {
              "name": ":P3",
              "value": "{{$_GET.time_from}}",
              "test": "2022-01-01 00:00"
            },
            {
              "name": ":P4",
              "value": "{{$_GET.time_to}}",
              "test": "2022-012-12 00:00"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "((select (sum((order_item_price * order_item_quantity) * ((100 - order_discount)/100) * ((100 - coverage_percentage)/100))) from servo_order_items left join servo_orders on (order_id = servo_orders_order_id) where order_time > '2022-01-01 00:00' and order_",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>