<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "order_id"
      },
      {
        "type": "number",
        "name": "order_amount_tendered"
      },
      {
        "type": "number",
        "name": "order_balance"
      },
      {
        "type": "text",
        "name": "order_status"
      },
      {
        "type": "text",
        "name": "servo_users_cashier_id"
      },
      {
        "type": "number",
        "name": "servo_payment_methods_payment_method"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_update_order",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "servo_orders",
                "column": "order_amount_tendered",
                "type": "number",
                "value": "{{$_POST.order_amount_tendered}}"
              },
              {
                "table": "servo_orders",
                "column": "order_balance",
                "type": "number",
                "value": "{{$_POST.order_balance}}"
              },
              {
                "table": "servo_orders",
                "column": "order_status",
                "type": "text",
                "value": "{{$_POST.order_status}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_users_cashier_id",
                "type": "number",
                "value": "{{$_POST.servo_users_cashier_id}}"
              },
              {
                "table": "servo_orders",
                "column": "servo_payment_methods_payment_method",
                "type": "number",
                "value": "{{$_POST.servo_payment_methods_payment_method}}"
              }
            ],
            "table": "servo_orders",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "order_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.order_id}}",
                  "data": {
                    "column": "order_id"
                  },
                  "operation": "="
                }
              ]
            },
            "query": "UPDATE servo_orders\nSET order_amount_tendered = :P1 /* {{$_POST.order_amount_tendered}} */, order_balance = :P2 /* {{$_POST.order_balance}} */, order_status = :P3 /* {{$_POST.order_status}} */, servo_users_cashier_id = :P4 /* {{$_POST.servo_users_cashier_id}} */, servo_payment_methods_payment_method = :P5 /* {{$_POST.servo_payment_methods_payment_method}} */\nWHERE order_id = :P6 /* {{$_POST.order_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.order_amount_tendered}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.order_balance}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.order_status}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.servo_users_cashier_id}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.servo_payment_methods_payment_method}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P6",
                "value": "{{$_POST.order_id}}"
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
        "name": "updateStockAfterOrder",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "insert into servo_stock_movement (stock_product_id, stock_quantity, stock_order_id) select servo_products_product_id, order_item_quantity, servo_orders_order_id from servo_order_items where servo_orders_order_id = :P8 /*{{$_POST.order_id}}*/",
            "params": [
              {
                "name": ":P8",
                "value": "{{$_POST.order_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "updateProductStockValue",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "update servo_products inner join servo_order_items on servo_products.product_id = servo_order_items.servo_products_product_id \nset product_stock_value = \n(\n  (product_stock_value) - \n  (select SUM(order_item_quantity) from servo_order_items where servo_order_items.servo_orders_order_id = :P8)) \n\nwhere product_id = servo_order_items.servo_products_product_id\n\n",
            "params": [
              {
                "name": ":P8",
                "value": "{{$_POST.order_id}}",
                "test": "1010"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "sum(stock_quantity)",
            "type": "text"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>