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
      },
      {
        "type": "text",
        "name": "department"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_report",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_name, product_category_name, SUM(order_item_quantity) as Volume, sum(order_item_quantity * order_item_price) as Total from servo_order_items\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_department on department_id = servo_order_items.servo_departments_department_id\n\nwhere servo_shift_shift_id = :P4 and order_item_group_type = 'Accessory' and order_item_status = 'Delivered'\nand department_id LIKE :P2\n\ngroup by product_name\norder by Volume DESC\n",
          "params": [
            {
              "name": ":P4",
              "value": "{{$_GET.shift}}",
              "test": "36"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.department}}",
              "test": "11"
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
      ]
    }
  }
}
JSON
);
?>