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
        "type": "number",
        "name": "servo_orders_order_id"
      },
      {
        "type": "number",
        "name": "servo_products_product_id"
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
        "name": "servo_departments_department_id"
      },
      {
        "type": "number",
        "name": "servo_users_user_ordered"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "add_order_item_to_ao",
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
              "column": "servo_departments_department_id",
              "type": "number",
              "value": "{{$_POST.servo_departments_department_id}}"
            },
            {
              "table": "servo_order_items",
              "column": "servo_users_user_ordered",
              "type": "number",
              "value": "{{$_POST.servo_users_user_ordered}}"
            }
          ],
          "table": "servo_order_items",
          "returning": "order_item_id",
          "query": "INSERT INTO servo_order_items\n(order_time_ordered, servo_orders_order_id, servo_products_product_id, order_item_notes, order_item_quantity, order_item_price, servo_departments_department_id, servo_users_user_ordered) VALUES (:P1 /* {{$_POST.order_time_ordered}} */, :P2 /* {{$_POST.servo_orders_order_id}} */, :P3 /* {{$_POST.servo_products_product_id}} */, :P4 /* {{$_POST.order_item_notes}} */, :P5 /* {{$_POST.order_item_quantity}} */, :P6 /* {{$_POST.order_item_price}} */, :P7 /* {{$_POST.servo_departments_department_id}} */, :P8 /* {{$_POST.servo_users_user_ordered}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.order_time_ordered}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.servo_orders_order_id}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.servo_products_product_id}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.order_item_notes}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.order_item_quantity}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.order_item_price}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.servo_departments_department_id}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.servo_users_user_ordered}}"
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