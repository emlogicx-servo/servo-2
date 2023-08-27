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
        "name": "po_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "servo_purchase_order_items"
            },
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
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_order_items",
                        "column": "po_product_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "product_id"
              }
            ],
            "orders": [],
            "query": "select * from `servo_purchase_order_items` inner join `servo_products` on `servo_products`.`product_id` = `servo_purchase_order_items`.`po_product_id` where `servo_purchase_order_items`.`po_id` = ?",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.po_id}}"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_purchase_order_items.po_id",
                  "field": "servo_purchase_order_items.po_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.po_id}}",
                  "data": {
                    "table": "servo_purchase_order_items",
                    "column": "po_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "primary": "po_item_id"
          }
        },
        "output": true,
        "meta": [
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
          }
        ],
        "outputType": "array"
      },
      {
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
                "table": "servo_products",
                "column": "product_picture"
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
                        "table": "servo_purchase_order_item_deletes",
                        "column": "po_item_deleted_product_id"
                      }
                    }
                  ]
                },
                "primary": "product_id"
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
                        "table": "servo_purchase_order_item_deletes",
                        "column": "po_user_deleted"
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
                  "operation": "=",
                  "table": "servo_purchase_order_item_deletes"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select `servo_purchase_order_item_deletes`.`po_item_delete_id`, `servo_purchase_order_item_deletes`.`po_item_id`, `servo_purchase_order_item_deletes`.`po_id`, `servo_purchase_order_item_deletes`.`po_item_quantity`, `servo_purchase_order_item_deletes`.`po_item_price`, `servo_purchase_order_item_deletes`.`po_user_deleted`, `servo_purchase_order_item_deletes`.`po_item_time_deleted`, `servo_purchase_order_item_deletes`.`po_item_deleted_product_id`, `servo_products`.`product_name`, `servo_products`.`product_picture`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username` from `servo_purchase_order_item_deletes` left join `servo_products` on `servo_products`.`product_id` = `servo_purchase_order_item_deletes`.`po_item_deleted_product_id` left join `servo_user` on `servo_user`.`user_id` = `servo_purchase_order_item_deletes`.`po_user_deleted` where `servo_purchase_order_item_deletes`.`po_id` = ?"
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
            "name": "product_picture"
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
      },
      {
        "name": "list_purchase_order_value_updates",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT old_value, new_value, updated_order_item_id, updated_po_item_id, updated_value, updated_time, product_name, user_username, product_min_stock\nFROM servo_changes_updates \nleft join servo_order_items on order_item_id = updated_order_item_id\nleft join servo_user on user_id = user_updated\nleft join servo_products on servo_products.product_id = updated_product_id\nwhere updated_po_id = :p1\nORDER BY updated_time DESC",
            "params": [
              {
                "name": ":p1",
                "value": "{{$_GET.po_id}}",
                "test": "29"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "old_value",
            "type": "text"
          },
          {
            "name": "new_value",
            "type": "text"
          },
          {
            "name": "updated_order_item_id",
            "type": "number"
          },
          {
            "name": "updated_po_item_id",
            "type": "number"
          },
          {
            "name": "updated_value",
            "type": "text"
          },
          {
            "name": "updated_time",
            "type": "datetime"
          },
          {
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "user_username",
            "type": "text"
          },
          {
            "name": "product_min_stock",
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