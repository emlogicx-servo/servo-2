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
        "type": "text",
        "name": "po_notes"
      },
      {
        "type": "number",
        "name": "po_id"
      },
      {
        "type": "date",
        "name": "po_need_by_date"
      },
      {
        "type": "number",
        "name": "po_discount"
      },
      {
        "type": "number",
        "name": "transfer_source_department_id"
      },
      {
        "type": "number",
        "name": "servo_departments_department_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_purchase_orders",
              "column": "servo_vendors_vendor_id",
              "type": "number",
              "value": "{{$_POST.servo_vendors_vendor_id.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_notes",
              "type": "text",
              "value": "{{$_POST.po_notes}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_id",
              "type": "number",
              "value": "{{$_POST.po_id}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_need_by_date",
              "type": "datetime",
              "value": "{{$_POST.po_need_by_date.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_discount",
              "type": "number",
              "value": "{{$_POST.po_discount}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "transfer_source_department_id",
              "type": "number",
              "value": "{{$_POST.transfer_source_department_id.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "servo_departments_department_id",
              "type": "number",
              "value": "{{$_POST.servo_departments_department_id.default(null)}}"
            }
          ],
          "table": "servo_purchase_orders",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "po_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.po_id}}",
                "data": {
                  "column": "po_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "update `servo_purchase_orders` set `servo_vendors_vendor_id` = ?, `po_notes` = ?, `po_id` = ?, `po_need_by_date` = ?, `po_discount` = ?, `transfer_source_department_id` = ?, `servo_departments_department_id` = ? where `po_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.servo_vendors_vendor_id.default(null)}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.po_notes}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.po_id}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.po_need_by_date.default(null)}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.po_discount}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.transfer_source_department_id.default(null)}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.servo_departments_department_id.default(null)}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P8",
              "value": "{{$_POST.po_id}}",
              "test": ""
            }
          ],
          "returning": "po_id"
        }
      },
      "meta": [
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