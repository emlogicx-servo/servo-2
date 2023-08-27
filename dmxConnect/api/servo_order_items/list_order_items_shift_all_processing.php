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
        "name": "shift_id"
      },
      {
        "type": "text",
        "name": "department_id"
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
              "table": "servo_order_items",
              "column": "order_item_id"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_ordered"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_ready"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_delivered"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_status"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_notes"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_quantity"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_price"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_discount"
            },
            {
              "table": "servo_order_items",
              "column": "order_time_processing"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_type"
            },
            {
              "table": "servo_order_items",
              "column": "servo_users_user_ordered"
            },
            {
              "table": "servo_order_items",
              "column": "order_item_group_type"
            },
            {
              "table": "servo_order_items",
              "column": "servo_departments_department_id"
            },
            {
              "table": "servo_orders",
              "column": "order_id"
            },
            {
              "table": "servo_orders",
              "column": "order_time"
            },
            {
              "table": "servo_orders",
              "column": "order_customer"
            },
            {
              "table": "servo_orders",
              "column": "order_discount"
            },
            {
              "table": "servo_orders",
              "column": "order_status"
            },
            {
              "table": "servo_orders",
              "column": "servo_user_user_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_customer_table_table_id"
            },
            {
              "table": "servo_orders",
              "column": "order_notes"
            },
            {
              "table": "servo_orders",
              "column": "servo_shift_shift_id"
            },
            {
              "table": "servo_orders",
              "column": "order_amount_tendered"
            },
            {
              "table": "servo_orders",
              "column": "order_balance"
            },
            {
              "table": "servo_orders",
              "column": "servo_users_cashier_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_payment_methods_payment_method"
            },
            {
              "table": "servo_orders",
              "column": "servo_departments_department_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_service_service_id"
            },
            {
              "table": "servo_orders",
              "column": "servo_service_service_id"
            },
            {
              "table": "servo_orders",
              "column": "coverage_percentage"
            },
            {
              "table": "servo_orders",
              "column": "coverage_partner"
            },
            {
              "table": "servo_orders",
              "column": "coverage_payment_status"
            },
            {
              "table": "servo_orders",
              "column": "order_time_paid"
            },
            {
              "table": "servo_products",
              "column": "product_id"
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
              "table": "servo_products",
              "column": "servo_product_brands_product_brand_id"
            },
            {
              "table": "servo_products",
              "column": "product_description"
            },
            {
              "table": "servo_products",
              "column": "servo_product_category_product_category_id"
            },
            {
              "table": "servo_products",
              "column": "product_standard_price"
            },
            {
              "table": "servo_products",
              "column": "product_discount"
            },
            {
              "table": "servo_products",
              "column": "product_type"
            },
            {
              "table": "servo_products",
              "column": "product_min_stock"
            },
            {
              "table": "servo_products",
              "column": "product_expiration_date"
            },
            {
              "table": "servo_products",
              "column": "product_sub_category_sub_category_id"
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
              "table": "servo_customer_table",
              "column": "table_id"
            },
            {
              "table": "servo_customer_table",
              "column": "table_name"
            }
          ],
          "table": {
            "name": "servo_order_items",
            "alias": "servo_order_items"
          },
          "joins": [
            {
              "table": "servo_orders",
              "column": "*",
              "alias": "servo_orders",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_orders",
                    "column": "order_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_orders_order_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "order_id"
            },
            {
              "table": "servo_products",
              "column": "*",
              "alias": "servo_products",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_order_items",
                      "column": "servo_products_product_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "product_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "alias": "servo_user",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_user_user_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_customer_table",
              "column": "*",
              "alias": "servo_customer_table",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customer_table",
                    "column": "table_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_orders",
                      "column": "servo_customer_table_table_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "table_id"
            }
          ],
          "query": "SELECT servo_order_items.order_item_id, servo_order_items.order_time_ordered, servo_order_items.order_time_ready, servo_order_items.order_time_delivered, servo_order_items.order_item_status, servo_order_items.order_item_notes, servo_order_items.order_item_quantity, servo_order_items.order_item_price, servo_order_items.order_item_discount, servo_order_items.order_time_processing, servo_order_items.order_item_type, servo_order_items.servo_users_user_ordered, servo_order_items.order_item_group_type, servo_order_items.servo_departments_department_id, servo_orders.order_id, servo_orders.order_time, servo_orders.order_customer, servo_orders.order_discount, servo_orders.order_status, servo_orders.servo_user_user_id, servo_orders.servo_customer_table_table_id, servo_orders.order_notes, servo_orders.servo_shift_shift_id, servo_orders.order_amount_tendered, servo_orders.order_balance, servo_orders.servo_users_cashier_id, servo_orders.servo_payment_methods_payment_method, servo_orders.servo_departments_department_id, servo_orders.servo_service_service_id, servo_orders.servo_service_service_id, servo_orders.coverage_percentage, servo_orders.coverage_partner, servo_orders.coverage_payment_status, servo_orders.order_time_paid, servo_products.product_id, servo_products.product_name, servo_products.product_picture, servo_products.servo_product_brands_product_brand_id, servo_products.product_description, servo_products.servo_product_category_product_category_id, servo_products.product_standard_price, servo_products.product_discount, servo_products.product_type, servo_products.product_min_stock, servo_products.product_expiration_date, servo_products.product_sub_category_sub_category_id, servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_user.servo_user_departments_department_id, servo_customer_table.table_id, servo_customer_table.table_name\nFROM servo_order_items AS servo_order_items\nLEFT JOIN servo_orders AS servo_orders ON servo_orders.order_id = servo_order_items.servo_orders_order_id LEFT JOIN servo_products AS servo_products ON servo_products.product_id = servo_order_items.servo_products_product_id LEFT JOIN servo_user AS servo_user ON servo_user.user_id = servo_orders.servo_user_user_id LEFT JOIN servo_customer_table AS servo_customer_table ON servo_customer_table.table_id = servo_orders.servo_customer_table_table_id\nWHERE servo_order_items.order_item_status = 'Processing' AND servo_orders.servo_shift_shift_id = :P1 /* {{$_GET.shift_id}} */ AND servo_order_items.servo_departments_department_id = :P2 /* {{$_GET.department_id}} */\nORDER BY servo_order_items.order_item_id ASC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.shift_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.department_id}}"
            }
          ],
          "orders": [
            {
              "table": "servo_order_items",
              "column": "order_item_id",
              "direction": "ASC",
              "recid": 1
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_order_items.order_item_status",
                "field": "servo_order_items.order_item_status",
                "type": "string",
                "operator": "equal",
                "value": "Processing",
                "data": {
                  "table": "servo_order_items",
                  "column": "order_item_status",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "maxLength": 45,
                    "primary": false,
                    "nullable": true,
                    "name": "order_item_status"
                  }
                },
                "operation": "="
              },
              {
                "id": "servo_orders.servo_shift_shift_id",
                "field": "servo_orders.servo_shift_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.shift_id}}",
                "data": {
                  "table": "servo_orders",
                  "column": "servo_shift_shift_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "shift_id",
                    "inTable": "servo_shifts",
                    "referenceType": "integer",
                    "onUpdate": "NO ACTION",
                    "onDelete": "NO ACTION",
                    "name": "servo_shift_shift_id"
                  }
                },
                "operation": "="
              },
              {
                "id": "servo_order_items.servo_departments_department_id",
                "field": "servo_order_items.servo_departments_department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department_id}}",
                "data": {
                  "table": "servo_order_items",
                  "column": "servo_departments_department_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "department_id",
                    "inTable": "servo_department",
                    "referenceType": "integer",
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
          },
          "primary": "order_item_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "order_item_id"
        },
        {
          "type": "datetime",
          "name": "order_time_ordered"
        },
        {
          "type": "datetime",
          "name": "order_time_ready"
        },
        {
          "type": "datetime",
          "name": "order_time_delivered"
        },
        {
          "type": "text",
          "name": "order_item_status"
        },
        {
          "type": "text",
          "name": "order_item_notes"
        },
        {
          "type": "number",
          "name": "order_item_quantity"
        },
        {
          "type": "number",
          "name": "order_item_price"
        },
        {
          "type": "number",
          "name": "order_item_discount"
        },
        {
          "type": "datetime",
          "name": "order_time_processing"
        },
        {
          "type": "text",
          "name": "order_item_type"
        },
        {
          "type": "number",
          "name": "servo_users_user_ordered"
        },
        {
          "type": "text",
          "name": "order_item_group_type"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
        },
        {
          "type": "number",
          "name": "order_id"
        },
        {
          "type": "datetime",
          "name": "order_time"
        },
        {
          "type": "number",
          "name": "order_customer"
        },
        {
          "type": "number",
          "name": "order_discount"
        },
        {
          "type": "text",
          "name": "order_status"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        },
        {
          "type": "number",
          "name": "servo_customer_table_table_id"
        },
        {
          "type": "text",
          "name": "order_notes"
        },
        {
          "type": "number",
          "name": "servo_shift_shift_id"
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
          "type": "number",
          "name": "servo_users_cashier_id"
        },
        {
          "type": "number",
          "name": "servo_payment_methods_payment_method"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "number",
          "name": "coverage_percentage"
        },
        {
          "type": "number",
          "name": "coverage_partner"
        },
        {
          "type": "text",
          "name": "coverage_payment_status"
        },
        {
          "type": "datetime",
          "name": "order_time_paid"
        },
        {
          "type": "number",
          "name": "product_id"
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
          "type": "number",
          "name": "servo_product_brands_product_brand_id"
        },
        {
          "type": "text",
          "name": "product_description"
        },
        {
          "type": "number",
          "name": "servo_product_category_product_category_id"
        },
        {
          "type": "number",
          "name": "product_standard_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "text",
          "name": "product_type"
        },
        {
          "type": "number",
          "name": "product_min_stock"
        },
        {
          "type": "datetime",
          "name": "product_expiration_date"
        },
        {
          "type": "number",
          "name": "product_sub_category_sub_category_id"
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
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>