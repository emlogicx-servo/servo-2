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
      },
      {
        "type": "text",
        "name": "department"
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
          "columns": [],
          "table": {
            "name": "servo_purchase_orders"
          },
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "type": "INNER",
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
            }
          ],
          "query": "SELECT *\nFROM servo_purchase_orders\nINNER JOIN servo_user ON (servo_user.user_id = servo_purchase_orders.servo_users_user_ordered_id)\nWHERE servo_purchase_orders.servo_departments_department_id = :P1 /* {{$_GET.department}} */\nORDER BY servo_purchase_orders.time_ordered DESC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.department}}"
            }
          ],
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
                "id": "servo_purchase_orders.servo_departments_department_id",
                "field": "servo_purchase_orders.servo_departments_department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department}}",
                "data": {
                  "table": "servo_purchase_orders",
                  "column": "servo_departments_department_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "department_id",
                    "inTable": "servo_department",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "servo_departments_department_id"
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
          "type": "text",
          "name": "password"
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