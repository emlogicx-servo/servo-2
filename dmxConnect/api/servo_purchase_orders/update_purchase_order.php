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
        "type": "datetime",
        "name": "po_need_by_date"
      },
      {
        "type": "number",
        "name": "po_discount"
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
              "value": "{{$_POST.servo_vendors_vendor_id}}"
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
              "value": "{{$_POST.po_need_by_date}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_discount",
              "type": "number",
              "value": "{{$_POST.po_discount}}"
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
          "query": "update `servo_purchase_orders` set `servo_vendors_vendor_id` = ?, `po_notes` = ?, `po_id` = ?, `po_need_by_date` = ?, `po_discount` = ? where `po_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.servo_vendors_vendor_id}}"
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
              "value": "{{$_POST.po_need_by_date}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.po_discount}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.po_id}}"
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