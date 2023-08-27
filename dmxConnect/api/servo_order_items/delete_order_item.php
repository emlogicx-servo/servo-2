<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "order_item_id"
      }
    ],
    "$_POST": [
      {
        "type": "datetime",
        "name": "time_deleted"
      },
      {
        "type": "number",
        "name": "user_deleted"
      },
      {
        "type": "number",
        "name": "order_item_id"
      },
      {
        "type": "number",
        "name": "deleted_product_id"
      },
      {
        "type": "text",
        "name": "order_id"
      },
      {
        "type": "number",
        "name": "deleted_item_quantity"
      },
      {
        "type": "number",
        "name": "deleted_order_item_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "delete",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "delete",
            "table": "servo_order_items",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "order_item_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.order_item_id}}",
                  "data": {
                    "column": "order_item_id"
                  },
                  "operation": "="
                }
              ]
            },
            "query": "DELETE\nFROM servo_order_items\nWHERE order_item_id = :P1 /* {{$_POST.order_item_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.order_item_id}}"
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
      },
      {
        "name": "insert_order_delete",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_order_item_deletes",
                "column": "time_deleted",
                "type": "datetime",
                "value": "{{NOW_UTC}}"
              },
              {
                "table": "servo_order_item_deletes",
                "column": "user_deleted",
                "type": "number",
                "value": "{{$_POST.user_deleted}}"
              },
              {
                "table": "servo_order_item_deletes",
                "column": "order_id",
                "type": "number",
                "value": "{{$_POST.order_id}}"
              },
              {
                "table": "servo_order_item_deletes",
                "column": "deleted_product_id",
                "type": "number",
                "value": "{{$_POST.deleted_product_id}}"
              },
              {
                "table": "servo_order_item_deletes",
                "column": "deleted_item_quantity",
                "type": "number",
                "value": "{{$_POST.deleted_item_quantity}}"
              },
              {
                "table": "servo_order_item_deletes",
                "column": "deleted_order_item_id",
                "type": "number",
                "value": "{{$_POST.deleted_order_item_id}}"
              }
            ],
            "table": "servo_order_item_deletes",
            "returning": "order_item_delete_id",
            "query": "INSERT INTO servo_order_item_deletes\n(time_deleted, user_deleted, order_id, deleted_product_id, deleted_item_quantity, deleted_order_item_id) VALUES (:P1 /* {{NOW_UTC}} */, :P2 /* {{$_POST.user_deleted}} */, :P3 /* {{$_POST.order_id}} */, :P4 /* {{$_POST.deleted_product_id}} */, :P5 /* {{$_POST.deleted_item_quantity}} */, :P6 /* {{$_POST.deleted_order_item_id}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{NOW_UTC}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.user_deleted}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.order_id}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.deleted_product_id}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.deleted_item_quantity}}",
                "test": ""
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.deleted_order_item_id}}",
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
        ]
      }
    ]
  }
}
JSON
);
?>