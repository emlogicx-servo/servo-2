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
        "name": "department_user"
      },
      {
        "type": "text",
        "name": "department"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_report_grouped",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_name, product_category_name, sum(order_item_quantity) as quantity from servo_order_items\n\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_user on user_id = servo_users_user_ordered\n\nleft join servo_department on department_id = servo_order_items.servo_departments_department_id\n\nleft join servo_customer_table on table_id = servo_customer_table_table_id\n\nwhere order_item_status = 'Delivered' and servo_shift_shift_id = :P4 and servo_user_user_prepared_id = :P2 and department_id = :P3\n\ngroup by product_name\n\norder by quantity desc\n",
          "params": [
            {
              "name": ":P4",
              "value": "{{$_GET.shift}}",
              "test": "36"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.department_user}}",
              "test": "8"
            },
            {
              "name": ":P3",
              "value": "{{$_GET.department}}",
              "test": "2"
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
          "name": "quantity",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>