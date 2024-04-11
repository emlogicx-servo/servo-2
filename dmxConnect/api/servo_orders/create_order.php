<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "order_time"
      },
      {
        "type": "number",
        "name": "order_customer"
      },
      {
        "type": "number",
        "name": "order_discount"
      },
      {
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "number",
        "name": "servo_user_user_id"
      },
      {
        "type": "number",
        "name": "servo_customer_table_table_id"
      },
      {
        "type": "number",
        "name": "servo_shift_shift_id"
      },
      {
        "type": "number",
        "name": "servo_departments_department_id"
      },
      {
        "type": "number",
        "name": "servo_service_service_id"
      },
      {
        "type": "number",
        "name": "order_pos"
      }
    ],
    "$_SESSION": [
      {
        "type": "text",
        "name": "table_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_insert_order",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_orders",
                "column": "order_time",
                "type": "datetime",
                "value": "{{$_POST.order_time}}"
              },
              {
                "table": "servo_orders",
                "column": "order_discount",
                "type": "number",
                "value": "{{$_POST.order_discount}}"
              },
              {
                "table": "servo_orders",
                "column": "order_status",
                "type": "text",
                "value": "{{$_POST.order_status}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_user_user_id",
                "type": "number",
                "value": "{{$_POST.servo_user_user_id}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_customer_table_table_id",
                "type": "number",
                "value": "{{$_POST.servo_customer_table_table_id}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_shift_shift_id",
                "type": "number",
                "value": "{{$_POST.servo_shift_shift_id}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_departments_department_id",
                "type": "number",
                "value": "{{$_POST.servo_departments_department_id}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_service_service_id",
                "type": "number",
                "value": "{{$_POST.servo_service_service_id}}"
              },
              {
                "table": "servo_orders",
                "column": "order_customer",
                "type": "number",
                "value": "{{$_POST.order_customer.default(null)}}"
              },
              {
                "table": "servo_orders",
                "column": "order_pos",
                "type": "number",
                "value": "{{$_POST.order_pos}}"
              }
            ],
            "table": "servo_orders",
            "returning": "order_id",
            "query": "insert into `servo_orders` (`order_customer`, `order_discount`, `order_pos`, `order_status`, `order_time`, `servo_customer_table_table_id`, `servo_departments_department_id`, `servo_service_service_id`, `servo_shift_shift_id`, `servo_user_user_id`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.order_time}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.order_discount}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.order_status}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.servo_user_user_id}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.servo_customer_table_table_id}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.servo_shift_shift_id}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.servo_departments_department_id}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.servo_service_service_id}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.order_customer.default(null)}}"
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.order_pos}}",
                "test": ""
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
      },
      {
        "name": "custom",
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
            "type": "number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "current_order",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{custom[0]['last_insert_id()']}}"
        },
        "meta": [],
        "outputType": "number",
        "output": true
      }
    ]
  }
}
JSON
);
?>