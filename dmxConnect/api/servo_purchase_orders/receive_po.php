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
    ],
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
      },
      {
        "type": "number",
        "name": "servo_users_user_received_id"
      },
      {
        "type": "datetime",
        "name": "time_received"
      },
      {
        "type": "number",
        "name": "stock_product_id"
      },
      {
        "type": "number",
        "name": "stock_po_id"
      },
      {
        "type": "number",
        "name": "stock_order_id"
      },
      {
        "type": "text",
        "name": "stock_movement"
      },
      {
        "type": "number",
        "name": "stock_quantity"
      },
      {
        "type": "datetime",
        "name": "stock_date"
      },
      {
        "type": "array",
        "name": "record",
        "sub": [
          {
            "type": "number",
            "name": "$_POST"
          },
          {
            "type": "number",
            "name": "stock_product_id"
          },
          {
            "type": "number",
            "name": "stock_po_id"
          },
          {
            "type": "number",
            "name": "stock_order_id"
          },
          {
            "type": "text",
            "name": "stock_movement"
          },
          {
            "type": "number",
            "name": "stock_quantity"
          },
          {
            "type": "datetime",
            "name": "stock_date"
          }
        ]
      }
    ]
  },
  "exec": {
    "steps": [
      {
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
                "column": "servo_users_user_received_id",
                "type": "number",
                "value": "{{$_POST.servo_users_user_received_id}}"
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
            "query": "UPDATE servo_purchase_orders\nSET servo_users_user_received_id = :P1 /* {{$_POST.servo_users_user_received_id}} */, time_received = :P2 /* {{$_POST.time_received}} */, po_status = :P3 /* {{$_POST.po_status}} */\nWHERE po_id = :P4 /* {{$_POST.po_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.servo_users_user_received_id}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.time_received}}"
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
            "query": "insert into servo_stock_movement (stock_product_id, stock_quantity, stock_po_id) select po_product_id, po_item_quantity, po_id from servo_purchase_order_items where po_id = :P4 /*{{$_POST.po_id}}*/",
            "params": [
              {
                "name": ":P4",
                "value": "{{$_POST.po_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array",
        "disabled": true
      }
    ]
  }
}
JSON
);
?>