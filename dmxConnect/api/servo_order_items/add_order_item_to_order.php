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
        "type": "datetime",
        "name": "order_time_ready"
      },
      {
        "type": "datetime",
        "name": "order_time_delivered"
      },
      {
        "type": "number",
        "name": "servo_user_user_prepared_id"
      },
      {
        "type": "text",
        "name": "order_item_type"
      },
      {
        "type": "number",
        "name": "servo_users_user_ordered"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "add_order_item_to_order",
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
            }
          ],
          "table": "servo_order_items",
          "returning": "order_item_id",
          "query": "INSERT INTO servo_order_items\n(order_time_ordered, order_time_ready, order_time_delivered, order_item_status, servo_orders_order_id, servo_products_product_id, servo_user_user_prepared_id, order_item_notes, order_item_quantity, order_item_price, order_item_type, servo_users_user_ordered) VALUES (:P1 /* {{$_POST.order_time_ordered}} */, :P2 /* {{$_POST.order_time_ready}} */, :P3 /* {{$_POST.order_time_delivered}} */, :P4 /* {{$_POST.order_item_status}} */, :P5 /* {{$_POST.servo_orders_order_id}} */, :P6 /* {{$_POST.servo_products_product_id}} */, :P7 /* {{$_POST.servo_user_user_prepared_id}} */, :P8 /* {{$_POST.order_item_notes}} */, :P9 /* {{$_POST.order_item_quantity}} */, :P10 /* {{$_POST.order_item_price}} */, :P11 /* {{$_POST.order_item_type}} */, :P12 /* {{$_POST.servo_users_user_ordered}} */)",
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