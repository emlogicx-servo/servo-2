<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "servo_users_user_approved_id"
      },
      {
        "type": "datetime",
        "name": "time_approved"
      },
      {
        "type": "text",
        "name": "po_status"
      },
      {
        "type": "number",
        "name": "po_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_po",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_purchase_orders",
              "column": "servo_users_user_approved_id",
              "type": "number",
              "value": "{{$_POST.servo_users_user_approved_id}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "time_approved",
              "type": "datetime",
              "value": "{{$_POST.time_approved}}"
            },
            {
              "table": "servo_purchase_orders",
              "column": "po_status",
              "type": "text",
              "value": "{{$_POST.po_status}}"
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
          "query": "UPDATE servo_purchase_orders\nSET servo_users_user_approved_id = :P1 /* {{$_POST.servo_users_user_approved_id}} */, time_approved = :P2 /* {{$_POST.time_approved}} */, po_status = :P3 /* {{$_POST.po_status}} */\nWHERE po_id = :P4 /* {{$_POST.po_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.servo_users_user_approved_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.time_approved}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.po_status}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
              "value": "{{$_POST.po_id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>