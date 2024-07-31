<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "order_time_ordered"
      },
      {
        "type": "text",
        "name": "order_item_status"
      },
      {
        "type": "number",
        "name": "servo_orders_order_id"
      },
      {
        "type": "number",
        "name": "servo_products_product_id"
      },
      {
        "type": "number",
        "name": "servo_user_user_id_ordered"
      },
      {
        "type": "number",
        "name": "servo_user_user_prepared_id"
      },
      {
        "type": "text",
        "name": "order_item_notes"
      },
      {
        "type": "number",
        "name": "order_item_quantity"
      },
      {
        "type": "number",
        "name": "order_item_price"
      },
      {
        "type": "number",
        "name": "order_item_discount"
      },
      {
        "type": "datetime",
        "name": "order_time_ready"
      },
      {
        "type": "datetime",
        "name": "order_time_delivered"
      },
      {
        "type": "text",
        "name": "order_item_type"
      },
      {
        "type": "number",
        "name": "servo_users_user_ordered"
      },
      {
        "type": "number",
        "name": "servo_departments_department_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_order_items",
              "column": "order_time_ordered",
              "type": "datetime",
              "value": "{{$_POST.order_time_ordered}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_ready",
              "type": "datetime",
              "value": "{{$_POST.order_time_ready}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_delivered",
              "type": "datetime",
              "value": "{{$_POST.order_time_delivered}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_status",
              "type": "text",
              "value": "{{$_POST.order_item_status}}"
            },
            {
              "table": "servo_order_items",
              "column": "servo_orders_order_id",
              "type": "number",
              "value": "{{$_POST.servo_orders_order_id}}"
            },
            {
              "table": "servo_order_items",
              "column": "servo_products_product_id",
              "type": "number",
              "value": "{{$_POST.servo_products_product_id}}"
            },
            {
              "table": "servo_order_items",
              "column": "servo_user_user_prepared_id",
              "type": "number",
              "value": "{{$_POST.servo_user_user_prepared_id}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_notes",
              "type": "text",
              "value": "{{$_POST.order_item_notes}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_quantity",
              "type": "number",
              "value": "{{$_POST.order_item_quantity}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_price",
              "type": "number",
              "value": "{{$_POST.order_item_price}}"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_type",
              "type": "text",
              "value": "{{$_POST.order_item_type}}"
            },
            {
              "table": "servo_order_items",
              "column": "servo_users_user_ordered",
              "type": "number",
              "value": "{{$_POST.servo_users_user_ordered}}"
            },
            {
              "table": "servo_order_items",
              "column": "servo_departments_department_id",
              "type": "number",
              "value": "{{$_POST.servo_departments_department_id}}"
            }
          ],
          "table": "servo_order_items",
          "returning": "order_item_id",
          "query": "insert into `servo_order_items` (`order_item_notes`, `order_item_price`, `order_item_quantity`, `order_item_status`, `order_item_type`, `order_time_delivered`, `order_time_ordered`, `order_time_ready`, `servo_departments_department_id`, `servo_orders_order_id`, `servo_products_product_id`, `servo_user_user_prepared_id`, `servo_users_user_ordered`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_time_ordered}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.order_time_ready}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.order_time_delivered}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.order_item_status}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.servo_orders_order_id}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.servo_products_product_id}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.servo_user_user_prepared_id}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.order_item_notes}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.order_item_quantity}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.order_item_price}}"
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.order_item_type}}"
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.servo_users_user_ordered}}"
            },
            {
              "name": ":P13",
              "type": "expression",
              "value": "{{$_POST.servo_departments_department_id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
        {
          "name": "affected",
          "type": "number"
        }
      ],
      "output": true
    }
  }
}
JSON
);
?>