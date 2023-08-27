<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "servo_users_user_ordered_id"
      },
      {
        "type": "datetime",
        "name": "time_ordered"
      },
      {
        "type": "text",
        "name": "po_status"
      },
      {
        "type": "text",
        "name": "po_notes"
      },
      {
        "type": "number",
        "name": "servo_users_user_approved_id"
      },
      {
        "type": "number",
        "name": "servo_users_user_received_id"
      },
      {
        "type": "datetime",
        "name": "time_approved"
      },
      {
        "type": "datetime",
        "name": "time_received"
      },
      {
        "type": "number",
        "name": "servo_departments_department_id"
      },
      {
        "type": "number",
        "name": "transfer_source_department_id"
      },
      {
        "type": "text",
        "name": "po_type"
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
                "table": "servo_purchase_orders",
                "column": "servo_users_user_ordered_id",
                "type": "number",
                "value": "{{$_POST.servo_users_user_ordered_id}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_users_user_approved_id",
                "type": "number",
                "value": "{{$_POST.servo_users_user_approved_id}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_users_user_received_id",
                "type": "number",
                "value": "{{$_POST.servo_users_user_received_id}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_ordered",
                "type": "datetime",
                "value": "{{$_POST.time_ordered}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_approved",
                "type": "datetime",
                "value": "{{$_POST.time_approved}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_received",
                "type": "datetime",
                "value": "{{$_POST.time_received}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_status",
                "type": "text",
                "value": "{{$_POST.po_status}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_notes",
                "type": "text",
                "value": "{{$_POST.po_notes}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_departments_department_id",
                "type": "number",
                "value": "{{$_POST.servo_departments_department_id}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "transfer_source_department_id",
                "type": "number",
                "value": "{{$_POST.transfer_source_department_id}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_type",
                "type": "text",
                "value": "{{$_POST.po_type}}"
              }
            ],
            "table": "servo_purchase_orders",
            "returning": "po_id",
            "query": "INSERT INTO servo_purchase_orders\n(servo_users_user_ordered_id, servo_users_user_approved_id, servo_users_user_received_id, time_ordered, time_approved, time_received, po_status, po_notes, servo_departments_department_id, transfer_source_department_id, po_type) VALUES (:P1 /* {{$_POST.servo_users_user_ordered_id}} */, :P2 /* {{$_POST.servo_users_user_approved_id}} */, :P3 /* {{$_POST.servo_users_user_received_id}} */, :P4 /* {{$_POST.time_ordered}} */, :P5 /* {{$_POST.time_approved}} */, :P6 /* {{$_POST.time_received}} */, :P7 /* {{$_POST.po_status}} */, :P8 /* {{$_POST.po_notes}} */, :P9 /* {{$_POST.servo_departments_department_id}} */, :P10 /* {{$_POST.transfer_source_department_id}} */, :P11 /* {{$_POST.po_type}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_ordered_id}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_approved_id}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_received_id}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.time_ordered}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.time_approved}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.time_received}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.po_status}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.po_notes}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.servo_departments_department_id}}"
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.transfer_source_department_id}}"
              },
              {
                "name": ":P11",
                "type": "expression",
                "value": "{{$_POST.po_type}}"
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
        "name": "last_insert_to",
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
        "name": "current_purchase_order",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{last_insert_to[0]['last_insert_id()']}}"
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