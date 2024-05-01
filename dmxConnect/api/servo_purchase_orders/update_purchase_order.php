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
      },
      {
        "type": "text",
        "name": "po_invoice_id"
      },
      {
        "type": "datetime",
        "name": "po_eta"
      },
      {
        "type": "text",
        "name": "po_goods_description"
      },
      {
        "type": "text",
        "name": "po_project_name"
      },
      {
        "type": "text",
        "name": "po_pr_number"
      },
      {
        "type": "text",
        "name": "po_importation_declaration_number"
      },
      {
        "type": "text",
        "name": "po_final_invoice_ref"
      },
      {
        "type": "number",
        "name": "po_agreed_advance_payment"
      },
      {
        "type": "number",
        "name": "po_agreed_balance"
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
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_invoice_id",
              "type": "text",
              "value": "{{$_POST.po_invoice_id.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_eta",
              "type": "datetime",
              "value": "{{$_POST.po_eta.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_goods_description",
              "type": "text",
              "value": "{{$_POST.po_goods_description.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_project_name",
              "type": "text",
              "value": "{{$_POST.po_project_name.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_pr_number",
              "type": "text",
              "value": "{{$_POST.po_pr_number.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_final_invoice_ref",
              "type": "text",
              "value": "{{$_POST.po_final_invoice_ref.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_agreed_advance_payment",
              "type": "number",
              "value": "{{$_POST.po_agreed_advance_payment.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_agreed_balance",
              "type": "number",
              "value": "{{$_POST.po_agreed_balance.default(null)}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_importation_declaration_number",
              "type": "text",
              "value": "{{$_POST.po_importation_declaration_number}}"
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
          "query": "update `servo_purchase_orders` set `servo_vendors_vendor_id` = ?, `po_notes` = ?, `po_id` = ?, `po_need_by_date` = ?, `po_discount` = ?, `transfer_source_department_id` = ?, `servo_departments_department_id` = ?, `po_invoice_id` = ?, `po_eta` = ?, `po_goods_description` = ?, `po_project_name` = ?, `po_pr_number` = ?, `po_final_invoice_ref` = ?, `po_agreed_advance_payment` = ?, `po_agreed_balance` = ?, `po_importation_declaration_number` = ? where `po_id` = ?",
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
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.po_invoice_id.default(null)}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.po_eta.default(null)}}",
              "test": ""
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.po_goods_description.default(null)}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.po_project_name.default(null)}}",
              "test": ""
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.po_pr_number.default(null)}}",
              "test": ""
            },
            {
              "name": ":P13",
              "type": "expression",
              "value": "{{$_POST.po_final_invoice_ref.default(null)}}",
              "test": ""
            },
            {
              "name": ":P14",
              "type": "expression",
              "value": "{{$_POST.po_agreed_advance_payment.default(null)}}",
              "test": ""
            },
            {
              "name": ":P15",
              "type": "expression",
              "value": "{{$_POST.po_agreed_balance.default(null)}}",
              "test": ""
            },
            {
              "name": ":P16",
              "type": "expression",
              "value": "{{$_POST.po_importation_declaration_number}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P17",
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