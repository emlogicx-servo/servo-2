<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "servo_vendors_vendor_id"
      },
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
        "name": "payment_status"
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
        "type": "text",
        "name": "payment_method"
      },
      {
        "type": "number",
        "name": "servo_departments_department_id"
      },
      {
        "type": "datetime",
        "name": "po_need_by_date"
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
                "column": "servo_vendors_vendor_id",
                "type": "number",
                "value": "{{$_POST.servo_vendors_vendor_id}}"
              },
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
                "column": "payment_method",
                "type": "text",
                "value": "{{$_POST.payment_method}}"
              },
              {
                "table": "servo_purchase_orders",
                "column": "payment_status",
                "type": "text",
                "value": "{{$_POST.payment_status}}"
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
                "column": "po_type",
                "type": "text",
                "value": "Purchase"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_need_by_date",
                "type": "datetime",
                "value": "{{$_POST.po_need_by_date.default(null)}}"
              }
            ],
            "table": "servo_purchase_orders",
            "returning": "po_id",
            "query": "insert into `servo_purchase_orders` (`payment_method`, `payment_status`, `po_need_by_date`, `po_notes`, `po_status`, `po_type`, `servo_departments_department_id`, `servo_users_user_approved_id`, `servo_users_user_ordered_id`, `servo_users_user_received_id`, `servo_vendors_vendor_id`, `time_approved`, `time_ordered`, `time_received`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.servo_vendors_vendor_id}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_ordered_id}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_approved_id}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_received_id}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.time_ordered}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.time_approved}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.time_received}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.po_status}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.payment_method}}"
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.payment_status}}"
              },
              {
                "name": ":P11",
                "type": "expression",
                "value": "{{$_POST.po_notes}}"
              },
              {
                "name": ":P12",
                "type": "expression",
                "value": "{{$_POST.servo_departments_department_id}}"
              },
              {
                "name": ":P13",
                "type": "expression",
                "value": "{{$_POST.po_need_by_date.default(null)}}",
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
        "name": "current_purchase_order",
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