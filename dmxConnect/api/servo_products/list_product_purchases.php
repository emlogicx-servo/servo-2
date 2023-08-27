<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_id"
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
      "name": "query_list_product_purchases",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "servo_purchase_order_items",
              "column": "po_product_id"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_quantity"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_price"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_notes"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_item_id"
            },
            {
              "table": "servo_purchase_order_items",
              "column": "po_id"
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
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_name"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_address"
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
              "value": "{{$_GET.product_id}}",
              "test": "103"
            }
          ],
          "table": {
            "name": "servo_purchase_order_items"
          },
          "primary": "po_item_id",
          "joins": [
            {
              "table": "servo_purchase_orders",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_purchase_orders",
                    "column": "po_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_purchase_order_items",
                      "column": "po_id"
                    }
                  }
                ]
              },
              "primary": "po_id"
            },
            {
              "table": "servo_products",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_purchase_order_items",
                      "column": "po_product_id"
                    }
                  }
                ]
              },
              "primary": "product_id"
            },
            {
              "table": "servo_vendors",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_vendors",
                    "column": "vendor_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_purchase_orders",
                      "column": "servo_vendors_vendor_id",
                      "type": "number"
                    }
                  }
                ]
              },
              "primary": "vendor_id"
            },
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
                    "operation": "=",
                    "value": {
                      "table": "servo_purchase_orders",
                      "column": "servo_users_user_received_id"
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
                "id": "servo_purchase_order_items.po_product_id",
                "field": "servo_purchase_order_items.po_product_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_id}}",
                "data": {
                  "table": "servo_purchase_order_items",
                  "column": "po_product_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": false,
                    "references": "product_id",
                    "inTable": "servo_products",
                    "referenceType": "integer",
                    "onUpdate": "NO ACTION",
                    "onDelete": "NO ACTION",
                    "name": "po_product_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "select `servo_purchase_order_items`.`po_product_id`, `servo_purchase_order_items`.`po_item_quantity`, `servo_purchase_order_items`.`po_item_price`, `servo_purchase_order_items`.`po_item_notes`, `servo_purchase_order_items`.`po_item_id`, `servo_purchase_order_items`.`po_id`, `servo_purchase_orders`.`time_ordered`, `servo_purchase_orders`.`time_approved`, `servo_purchase_orders`.`time_received`, `servo_purchase_orders`.`po_status`, `servo_products`.`product_name`, `servo_vendors`.`vendor_name`, `servo_vendors`.`vendor_address`, `servo_user`.`user_username` from `servo_purchase_order_items` left join `servo_purchase_orders` on `servo_purchase_orders`.`po_id` = `servo_purchase_order_items`.`po_id` left join `servo_products` on `servo_products`.`product_id` = `servo_purchase_order_items`.`po_product_id` inner join `servo_vendors` on `servo_vendors`.`vendor_id` = `servo_purchase_orders`.`servo_vendors_vendor_id` left join `servo_user` on `servo_user`.`user_id` = `servo_purchase_orders`.`servo_users_user_received_id` where `servo_purchase_order_items`.`po_product_id` = ? order by `servo_purchase_orders`.`time_received` DESC",
          "orders": [
            {
              "table": "servo_purchase_orders",
              "column": "time_received",
              "direction": "DESC"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
            {
              "type": "number",
              "name": "po_product_id"
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
              "type": "text",
              "name": "po_item_notes"
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
              "type": "text",
              "name": "product_name"
            },
            {
              "type": "text",
              "name": "vendor_name"
            },
            {
              "type": "text",
              "name": "vendor_address"
            },
            {
              "type": "text",
              "name": "user_username"
            }
          ]
        }
      ],
      "type": "dbconnector_paged_select",
      "outputType": "object"
    }
  }
}
JSON
);
?>