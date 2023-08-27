<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "servo_orders_order_id"
      },
      {
        "type": "text",
        "name": "servo_users_user_ordered"
      },
      {
        "type": "text",
        "name": "product_group_id"
      },
      {
        "type": "text",
        "name": "order_time_ordered"
      },
      {
        "type": "text",
        "name": "order_item_group_reference"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "add_grouped_products_to_order_main",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "insert into servo_order_items (servo_users_user_ordered, servo_orders_order_id, order_item_status, order_time_ordered, order_item_type, servo_products_product_id, order_item_quantity, order_item_price, order_item_group_type, servo_departments_department_id, order_item_group_id, order_item_group_reference)\n\nselect :P2, :P1, 'Pending', :P4, 'Group', product_group_product_id, \n product_group_product_quantity, \n product_group_product_unit_price, product_group_item_type, group_product_department, product_group_product_group_id, :P5 \n\nfrom servo_product_group_items inner join servo_product_groups on product_group_product_group_id = product_group_id\nwhere product_group_product_group_id = :P3 and product_group_item_type = 'Main'",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_POST.servo_orders_order_id}}",
                "test": "329"
              },
              {
                "name": ":P2",
                "value": "{{$_POST.servo_users_user_ordered}}",
                "test": "4"
              },
              {
                "name": ":P3",
                "value": "{{$_POST.product_group_id}}",
                "test": "1"
              },
              {
                "name": ":P4",
                "value": "{{$_POST.order_time_ordered}}",
                "test": "2023-07-26 13:44:54"
              },
              {
                "name": ":P5",
                "value": "{{$_POST.order_item_group_reference}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "lastInsert",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "text"
          }
        ]
      },
      {
        "name": "add_grouped_products_to_order_accessories",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "insert into servo_order_items (servo_users_user_ordered, servo_orders_order_id, order_item_status, order_time_ordered, order_item_type, servo_products_product_id, order_item_quantity, order_item_price, order_item_group_type, servo_departments_department_id, order_item_group_id, order_item_group_reference)\n\nselect :P2, :P1, 'Pending', :P4, 'Group', product_group_product_id, \n product_group_product_quantity, \n product_group_product_unit_price, product_group_item_type, group_product_department, product_group_product_group_id, :P5 \n\nfrom servo_product_group_items inner join servo_product_groups on product_group_product_group_id = product_group_id\nwhere product_group_product_group_id = :P3 and product_group_item_type != 'Main'",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_POST.servo_orders_order_id}}"
              },
              {
                "name": ":P2",
                "value": "{{$_POST.servo_users_user_ordered}}"
              },
              {
                "name": ":P3",
                "value": "{{$_POST.product_group_id}}"
              },
              {
                "name": ":P4",
                "value": "{{$_POST.order_time_ordered}}"
              },
              {
                "name": ":P5",
                "value": "{{$_POST.order_item_group_reference}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "add_grouped_products_to_order_copy",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "insert into servo_order_items (servo_users_user_ordered, servo_orders_order_id, order_item_status, order_time_ordered, order_item_type, servo_products_product_id, order_item_quantity, order_item_price, order_item_group_type, servo_departments_department_id, order_item_group_id)\n\nselect :P2, :P1, 'Pending', :P4, 'Group', product_group_product_id, \n product_group_product_quantity, \n product_group_product_unit_price, product_group_item_type, group_product_department, product_group_product_group_id \n\nfrom servo_product_group_items inner join servo_product_groups on product_group_product_group_id = product_group_id\nwhere product_group_product_group_id = :P3",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_POST.servo_orders_order_id}}"
              },
              {
                "name": ":P2",
                "value": "{{$_POST.servo_users_user_ordered}}"
              },
              {
                "name": ":P3",
                "value": "{{$_POST.product_group_id}}"
              },
              {
                "name": ":P4",
                "value": "{{$_POST.order_time_ordered}}"
              }
            ]
          }
        },
        "meta": [],
        "outputType": "array",
        "disabled": true
      }
    ]
  }
}
JSON
);
?>