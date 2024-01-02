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
      "name": "query_product_sale_single",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select *, SUM(order_item_quantity * order_item_price) as AMOUNT\n\nfrom servo_order_items \n\ninner join\nservo_products on (servo_products.product_id = servo_order_items.servo_products_product_id)\n\ninner join \nservo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\ninner join \nservo_customers on order_customer = customer_id\n\nWHERE servo_order_items.order_time_ordered between ? and ?\nand product_id = :P2\ngroup by servo_order_items.order_time_ordered\norder by order_time_ordered DESC",
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
          "name": "order_item_id",
          "type": "number"
        },
        {
          "name": "order_time_ordered",
          "type": "datetime"
        },
        {
          "name": "order_time_ready",
          "type": "datetime"
        },
        {
          "name": "order_time_delivered",
          "type": "datetime"
        },
        {
          "name": "order_item_status",
          "type": "text"
        },
        {
          "name": "servo_orders_order_id",
          "type": "number"
        },
        {
          "name": "servo_products_product_id",
          "type": "number"
        },
        {
          "name": "servo_user_user_prepared_id",
          "type": "number"
        },
        {
          "name": "order_item_notes",
          "type": "file"
        },
        {
          "name": "order_item_quantity",
          "type": "text"
        },
        {
          "name": "order_item_price",
          "type": "text"
        },
        {
          "name": "order_item_discount",
          "type": "number"
        },
        {
          "name": "order_time_processing",
          "type": "datetime"
        },
        {
          "name": "order_item_type",
          "type": "file"
        },
        {
          "name": "servo_users_user_ordered",
          "type": "number"
        },
        {
          "name": "order_item_group_type",
          "type": "file"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "order_item_group_id",
          "type": "number"
        },
        {
          "name": "order_item_group_reference",
          "type": "text"
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
          "name": "order_id",
          "type": "number"
        },
        {
          "name": "order_time",
          "type": "datetime"
        },
        {
          "name": "order_customer",
          "type": "number"
        },
        {
          "name": "order_discount",
          "type": "number"
        },
        {
          "name": "order_status",
          "type": "text"
        },
        {
          "name": "servo_user_user_id",
          "type": "number"
        },
        {
          "name": "servo_customer_table_table_id",
          "type": "number"
        },
        {
          "name": "order_notes",
          "type": "file"
        },
        {
          "name": "servo_shift_shift_id",
          "type": "number"
        },
        {
          "name": "order_amount_tendered",
          "type": "number"
        },
        {
          "name": "order_balance",
          "type": "number"
        },
        {
          "name": "servo_users_cashier_id",
          "type": "number"
        },
        {
          "name": "servo_payment_methods_payment_method",
          "type": "number"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "servo_service_service_id",
          "type": "number"
        },
        {
          "name": "coverage_percentage",
          "type": "number"
        },
        {
          "name": "coverage_partner",
          "type": "number"
        },
        {
          "name": "coverage_payment_status",
          "type": "file"
        },
        {
          "name": "order_time_paid",
          "type": "datetime"
        },
        {
          "name": "order_extra_info",
          "type": "file"
        },
        {
          "name": "customer_id",
          "type": "number"
        },
        {
          "name": "customer_first_name",
          "type": "file"
        },
        {
          "name": "customer_last_name",
          "type": "file"
        },
        {
          "name": "customer_phone_number",
          "type": "text"
        },
        {
          "name": "customer_picture",
          "type": "text"
        },
        {
          "name": "customer_class",
          "type": "file"
        },
        {
          "name": "customer_sex",
          "type": "file"
        },
        {
          "name": "customer_dob",
          "type": "datetime"
        },
        {
          "name": "customer_age",
          "type": "number"
        },
        {
          "name": "customer_address",
          "type": "file"
        },
        {
          "name": "id_card_number",
          "type": "number"
        },
        {
          "name": "location_lat",
          "type": "file"
        },
        {
          "name": "locatio_lon",
          "type": "file"
        },
        {
          "name": "customer_city",
          "type": "number"
        },
        {
          "name": "customer_building_photo",
          "type": "text"
        },
        {
          "name": "customer_location_diretions",
          "type": "file"
        },
        {
          "name": "customer_nationality",
          "type": "number"
        },
        {
          "name": "customer_email",
          "type": "text"
        },
        {
          "name": "customer_legal_status",
          "type": "file"
        },
        {
          "name": "customer_tax_payer_number",
          "type": "text"
        },
        {
          "name": "customer_rep_name",
          "type": "file"
        },
        {
          "name": "customer_rep_surname",
          "type": "file"
        },
        {
          "name": "customer_rep_id_card",
          "type": "text"
        },
        {
          "name": "customer_rep_address",
          "type": "file"
        },
        {
          "name": "customer_rep_phone",
          "type": "text"
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