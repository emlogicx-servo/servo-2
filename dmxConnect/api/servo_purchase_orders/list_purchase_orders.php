<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_purchase_orders",
              "column": "po_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "servo_vendors_vendor_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "servo_users_user_ordered_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "servo_users_user_approved_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "servo_users_user_received_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "time_ordered"
            },
            {
              "table": "servo_purchase_orders",
              "column": "time_approved"
            },
            {
              "table": "servo_purchase_orders",
              "column": "time_received"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_status"
            },
            {
              "table": "servo_purchase_orders",
              "column": "payment_method"
            },
            {
              "table": "servo_purchase_orders",
              "column": "payment_status"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_notes"
            },
            {
              "table": "servo_purchase_orders",
              "column": "servo_departments_department_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_need_by_date"
            },
            {
              "table": "servo_purchase_orders",
              "column": "transfer_source_department_id"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_type"
            },
            {
              "table": "servo_user",
              "column": "user_id"
            },
            {
              "table": "servo_user",
              "column": "user_fname"
            },
            {
              "table": "servo_user",
              "column": "user_lname"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_user",
              "column": "servo_user_departments_department_id"
            },
            {
              "table": "servo_user",
              "column": "user_profile"
            }
          ],
          "table": {
            "name": "servo_purchase_orders"
          },
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_purchase_orders",
                      "column": "servo_users_user_ordered_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_department",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_department",
                    "column": "department_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user",
                      "column": "servo_user_departments_department_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "department_id"
            }
          ],
          "query": "SELECT servo_purchase_orders.po_id, servo_purchase_orders.servo_vendors_vendor_id, servo_purchase_orders.servo_users_user_ordered_id, servo_purchase_orders.servo_users_user_approved_id, servo_purchase_orders.servo_users_user_received_id, servo_purchase_orders.time_ordered, servo_purchase_orders.time_approved, servo_purchase_orders.time_received, servo_purchase_orders.po_status, servo_purchase_orders.payment_method, servo_purchase_orders.payment_status, servo_purchase_orders.po_notes, servo_purchase_orders.servo_departments_department_id, servo_purchase_orders.po_need_by_date, servo_purchase_orders.transfer_source_department_id, servo_purchase_orders.po_type, servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.servo_user_departments_department_id, servo_user.user_profile\nFROM servo_purchase_orders\nLEFT JOIN servo_user ON (servo_user.user_id = servo_purchase_orders.servo_users_user_ordered_id) LEFT JOIN servo_department ON (servo_department.department_id = servo_user.servo_user_departments_department_id)\nWHERE servo_purchase_orders.po_type = 'Purchase'\nORDER BY servo_purchase_orders.time_ordered DESC",
          "params": [],
          "orders": [
            {
              "table": "servo_purchase_orders",
              "column": "time_ordered",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "primary": "po_id",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_purchase_orders.po_type",
                "field": "servo_purchase_orders.po_type",
                "type": "string",
                "operator": "equal",
                "value": "Purchase",
                "data": {
                  "table": "servo_purchase_orders",
                  "column": "po_type",
                  "type": "text",
                  "columnObj": {
                    "type": "enum",
                    "nullable": true,
                    "name": "po_type"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "number",
          "name": "servo_vendors_vendor_id"
        },
        {
          "type": "number",
          "name": "servo_users_user_ordered_id"
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
          "name": "time_ordered"
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
          "name": "po_status"
        },
        {
          "type": "number",
          "name": "payment_method"
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
          "name": "servo_departments_department_id"
        },
        {
          "type": "datetime",
          "name": "po_need_by_date"
        },
        {
          "type": "number",
          "name": "transfer_source_department_id"
        },
        {
          "type": "text",
          "name": "po_type"
        },
        {
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "servo_user_departments_department_id"
        },
        {
          "type": "text",
          "name": "user_profile"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>