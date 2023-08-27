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
      },
      {
        "type": "text",
        "name": "status"
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
          "query": "select servo_order_items.servo_departments_department_id, servo_orders.order_extra_info, order_item_id, order_time_ordered, order_time_ready, order_time_delivered, order_item_status, order_item_notes, order_item_quantity, order_time_processing, servo_user_user_prepared_id, servo_users_user_ordered, order_id, order_time, order_customer, customer_first_name, customer_last_name, order_status, table_name, servo_user_user_id, servo_service_service_id, product_name, product_category_name, user_id, user_fname, user_lname, user_username, department_name, service_name, order_item_group_type, order_item_type, (select user_username from servo_user where user_id = servo_user_user_prepared_id) as user_prepared from servo_order_items\n\n\nleft join servo_products on (servo_products.product_id = servo_order_items.servo_products_product_id) \n\nleft join servo_department on servo_order_items.servo_departments_department_id = servo_department.department_id\n\nleft join servo_product_categories on (servo_products.servo_product_category_product_category_id = servo_product_categories.product_categories_id)\n\nleft join servo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nleft join servo_user on user_id = servo_users_user_ordered\n\nleft join servo_customer_table on table_id = servo_customer_table_table_id\n\nleft join servo_customers on servo_customers.customer_id = servo_orders.order_customer\n\nleft join servo_services on service_id = servo_service_service_id\n\nwhere servo_shift_shift_id = :P4 and servo_order_items.servo_departments_department_id LIKE :P2 and order_item_status LIKE :P3\n\norder by order_time_ordered desc\n",
          "params": [
            {
              "name": ":P4",
              "value": "{{$_GET.shift}}",
              "test": "36"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.department}}",
              "test": "2"
            },
            {
              "name": ":P3",
              "value": "{{$_GET.status}}",
              "test": "Ordered"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "order_extra_info",
          "type": "file"
        },
        {
          "name": "order_item_id",
          "type": "number"
        },
        {
          "name": "order_time_ordered",
          "type": "datetime"
        },
        {
          "name": "order_time_ready",
          "type": "datetime"
        },
        {
          "name": "order_time_delivered",
          "type": "datetime"
        },
        {
          "name": "order_item_status",
          "type": "text"
        },
        {
          "name": "order_item_notes",
          "type": "file"
        },
        {
          "name": "order_item_quantity",
          "type": "text"
        },
        {
          "name": "order_time_processing",
          "type": "datetime"
        },
        {
          "name": "servo_user_user_prepared_id",
          "type": "number"
        },
        {
          "name": "servo_users_user_ordered",
          "type": "number"
        },
        {
          "name": "order_id",
          "type": "number"
        },
        {
          "name": "order_time",
          "type": "datetime"
        },
        {
          "name": "order_customer",
          "type": "number"
        },
        {
          "name": "customer_first_name",
          "type": "file"
        },
        {
          "name": "customer_last_name",
          "type": "file"
        },
        {
          "name": "order_status",
          "type": "text"
        },
        {
          "name": "table_name",
          "type": "text"
        },
        {
          "name": "servo_user_user_id",
          "type": "number"
        },
        {
          "name": "servo_service_service_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "product_category_name",
          "type": "text"
        },
        {
          "name": "user_id",
          "type": "number"
        },
        {
          "name": "user_fname",
          "type": "text"
        },
        {
          "name": "user_lname",
          "type": "text"
        },
        {
          "name": "user_username",
          "type": "text"
        },
        {
          "name": "department_name",
          "type": "text"
        },
        {
          "name": "service_name",
          "type": "text"
        },
        {
          "name": "order_item_group_type",
          "type": "file"
        },
        {
          "name": "order_item_type",
          "type": "file"
        },
        {
          "name": "user_prepared",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>