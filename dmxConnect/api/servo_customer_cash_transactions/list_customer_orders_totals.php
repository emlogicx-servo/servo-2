<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "customer_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "custom_list_customer_orders_totals",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n(select (sum((order_item_price * order_item_quantity) * ((100 - order_discount)/100) * ((100 - coverage_percentage)/100))) from servo_order_items inner join servo_orders on (order_id = servo_orders_order_id) where order_customer = :P1) as 'Customer Orders Totals',\n\n(select (sum((order_item_price * order_item_quantity) * ((coverage_percentage)/100))) from servo_order_items inner join servo_orders on (order_id = servo_orders_order_id) where order_customer = :P1) as 'Coverage Totals',\n\n(select (sum((order_item_price * order_item_quantity) * ((coverage_percentage)/100))) from servo_order_items inner join servo_orders on (order_id = servo_orders_order_id) where coverage_partner = :P1) as 'Total Covered'\n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.customer_id}}",
              "test": "10558"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "Customer Orders Totals",
          "type": "text"
        },
        {
          "name": "Coverage Totals",
          "type": "text"
        },
        {
          "name": "Total Covered",
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