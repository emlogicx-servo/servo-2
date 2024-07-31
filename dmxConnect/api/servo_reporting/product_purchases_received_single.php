<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "date_start"
      },
      {
        "type": "text",
        "name": "date_end"
      },
      {
        "type": "text",
        "name": "product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "product_purchases_received_single",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select *, SUM(po_item_quantity * po_item_price) as AMOUNT\n\nfrom servo_purchase_order_items\n\nleft join\nservo_products on (servo_products.product_id = servo_purchase_order_items.po_product_id)\n\nleft join \nservo_purchase_orders on (servo_purchase_order_items.po_id = servo_purchase_orders.po_id)\n\nleft join servo_vendors on vendor_id = servo_vendors_vendor_id\n\nWHERE servo_purchase_orders.time_received between ? and ?\nand product_id = :P2\nand po_status = 'Received'\ngroup by servo_purchase_orders.time_received",
          "params": [
            {
              "name": "?",
              "value": "{{$_GET.date_start}}",
              "test": "2022-04-01 01:43:08"
            },
            {
              "name": "?",
              "value": "{{$_GET.date_end}}",
              "test": "2022-04-11 01:43:08"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.product_id}}",
              "test": "41"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "po_product_id",
          "type": "number"
        },
        {
          "name": "po_item_quantity",
          "type": "text"
        },
        {
          "name": "po_item_price",
          "type": "text"
        },
        {
          "name": "po_item_notes",
          "type": "file"
        },
        {
          "name": "po_item_id",
          "type": "number"
        },
        {
          "name": "po_id",
          "type": "number"
        },
        {
          "name": "po_item_status",
          "type": "file"
        },
        {
          "name": "po_item_time_received",
          "type": "datetime"
        },
        {
          "name": "po_item_user_received",
          "type": "number"
        },
        {
          "name": "product_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "product_picture",
          "type": "text"
        },
        {
          "name": "servo_product_brands_product_brand_id",
          "type": "number"
        },
        {
          "name": "product_description",
          "type": "file"
        },
        {
          "name": "servo_product_category_product_category_id",
          "type": "number"
        },
        {
          "name": "product_standard_price",
          "type": "number"
        },
        {
          "name": "product_discount",
          "type": "number"
        },
        {
          "name": "product_type",
          "type": "file"
        },
        {
          "name": "product_stock_value",
          "type": "number"
        },
        {
          "name": "product_min_stock",
          "type": "number"
        },
        {
          "name": "product_expiration_date",
          "type": "datetime"
        },
        {
          "name": "product_sub_category_sub_category_id",
          "type": "number"
        },
        {
          "name": "product_reference_uom",
          "type": "file"
        },
        {
          "name": "po_id",
          "type": "number"
        },
        {
          "name": "servo_vendors_vendor_id",
          "type": "number"
        },
        {
          "name": "servo_users_user_ordered_id",
          "type": "number"
        },
        {
          "name": "servo_users_user_approved_id",
          "type": "number"
        },
        {
          "name": "servo_users_user_received_id",
          "type": "number"
        },
        {
          "name": "time_ordered",
          "type": "datetime"
        },
        {
          "name": "time_approved",
          "type": "datetime"
        },
        {
          "name": "time_received",
          "type": "datetime"
        },
        {
          "name": "po_status",
          "type": "text"
        },
        {
          "name": "payment_method",
          "type": "number"
        },
        {
          "name": "payment_status",
          "type": "text"
        },
        {
          "name": "po_notes",
          "type": "file"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "po_need_by_date",
          "type": "datetime"
        },
        {
          "name": "transfer_source_department_id",
          "type": "number"
        },
        {
          "name": "po_type",
          "type": "text"
        },
        {
          "name": "po_discount",
          "type": "number"
        },
        {
          "name": "po_payment_status",
          "type": "text"
        },
        {
          "name": "po_invoice_id",
          "type": "text"
        },
        {
          "name": "po_eta",
          "type": "datetime"
        },
        {
          "name": "po_goods_description",
          "type": "file"
        },
        {
          "name": "po_project_name",
          "type": "text"
        },
        {
          "name": "po_pr_number",
          "type": "text"
        },
        {
          "name": "po_importation_declaration_number",
          "type": "text"
        },
        {
          "name": "po_final_invoice_ref",
          "type": "text"
        },
        {
          "name": "po_agreed_advance_payment",
          "type": "number"
        },
        {
          "name": "po_agreed_balance",
          "type": "number"
        },
        {
          "name": "vendor_id",
          "type": "number"
        },
        {
          "name": "vendor_name",
          "type": "file"
        },
        {
          "name": "vendor_address",
          "type": "text"
        },
        {
          "name": "vendor_phone_number",
          "type": "number"
        },
        {
          "name": "AMOUNT",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>