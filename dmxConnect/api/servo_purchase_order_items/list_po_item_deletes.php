<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "po_id"
      },
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
      "name": "list_po_item_deletes",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_delete_id"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_id"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_id"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_quantity"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_price"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_user_deleted"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_time_deleted"
            },
            {
              "table": "servo_purchase_order_item_deletes",
              "column": "po_item_deleted_product_id"
            },
            {
              "table": "servo_products",
              "column": "product_name"
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
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.po_id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "servo_purchase_order_item_deletes"
          },
          "primary": "po_item_delete_id",
          "joins": [
            {
              "table": "servo_products",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_purchase_order_item_deletes",
                      "column": "po_item_deleted_product_id",
                      "type": "number"
                    }
                  }
                ]
              },
              "primary": "product_id"
            },
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
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_purchase_order_item_deletes",
                      "column": "po_user_deleted",
                      "type": "number"
                    }
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_purchase_order_item_deletes.po_id",
                "field": "servo_purchase_order_item_deletes.po_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.po_id}}",
                "data": {
                  "table": "servo_purchase_order_item_deletes",
                  "column": "po_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": false,
                    "references": "po_id",
                    "inTable": "servo_purchase_orders",
                    "referenceType": "integer",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "po_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "select `servo_purchase_order_item_deletes`.`po_item_delete_id`, `servo_purchase_order_item_deletes`.`po_item_id`, `servo_purchase_order_item_deletes`.`po_id`, `servo_purchase_order_item_deletes`.`po_item_quantity`, `servo_purchase_order_item_deletes`.`po_item_price`, `servo_purchase_order_item_deletes`.`po_user_deleted`, `servo_purchase_order_item_deletes`.`po_item_time_deleted`, `servo_purchase_order_item_deletes`.`po_item_deleted_product_id`, `servo_products`.`product_name`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username` from `servo_purchase_order_item_deletes` inner join `servo_products` on `servo_products`.`product_id` = `servo_purchase_order_item_deletes`.`po_item_deleted_product_id` inner join `servo_user` on `servo_user`.`user_id` = `servo_purchase_order_item_deletes`.`po_user_deleted` where `servo_purchase_order_item_deletes`.`po_id` = ?"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "po_item_delete_id"
        },
        {
          "type": "number",
          "name": "po_item_id"
        },
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "number",
          "name": "po_item_quantity"
        },
        {
          "type": "number",
          "name": "po_item_price"
        },
        {
          "type": "number",
          "name": "po_user_deleted"
        },
        {
          "type": "datetime",
          "name": "po_item_time_deleted"
        },
        {
          "type": "number",
          "name": "po_item_deleted_product_id"
        },
        {
          "type": "text",
          "name": "product_name"
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>