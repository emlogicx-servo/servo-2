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
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "number",
        "name": "servo_user_user_id"
      },
      {
        "type": "number",
        "name": "servo_departments_department_id"
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
                "value": "{{NOW_UTC}}"
              },
              {
                "table": "servo_orders",
                "column": "order_status",
                "type": "text",
                "value": "Adjustment"
              },
              {
                "table": "servo_orders",
                "column": "servo_user_user_id",
                "type": "number",
                "value": "{{$_POST.servo_user_user_id}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_departments_department_id",
                "type": "number",
                "value": "{{$_POST.servo_departments_department_id}}"
              }
            ],
            "table": "servo_orders",
            "returning": "order_id",
            "query": "INSERT INTO servo_orders\n(order_time, order_status, servo_user_user_id, servo_departments_department_id) VALUES (:P1 /* {{NOW_UTC}} */, 'Adjustment', :P2 /* {{$_POST.servo_user_user_id}} */, :P3 /* {{$_POST.servo_departments_department_id}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{NOW_UTC}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.servo_user_user_id}}"
              },
              {
                "name": ":P3",
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
        "name": "current_adjustment_order",
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