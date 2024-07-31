<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "shift_id"
      },
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
        "name": "service_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "shift_sales_data",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select shift_id, \n\n(select sum(transaction_amount) from servo_customer_cash_transaction left join servo_orders on order_id = transaction_order where servo_shift_shift_id = :P1 and servo_service_service_id like :P2) as TotalPaid,\n\n(select sum(transaction_amount) from servo_customer_cash_transaction left join servo_orders on order_id = transaction_order where order_status = 'Ordered' and servo_shift_shift_id = :P1 and servo_service_service_id like :P2) as TotalOpenPaid,\n\n(select (sum(order_item_quantity * order_item_price) * (100 - order_discount)/100) from servo_order_items left join servo_orders on order_id = servo_orders_order_id where order_status = 'Ordered' and servo_shift_shift_id = :P1 and servo_service_service_id like :P2) as TotalOpenUnpaid,\n\n(select (sum(order_item_quantity * order_item_price) * (100 - order_discount)/100) from servo_order_items left join servo_orders on order_id = servo_orders_order_id where servo_shift_shift_id = :P1 and servo_service_service_id like :P2) as TotalSales,\n\n(select sum(order_total_adjustment) from servo_orders where servo_shift_shift_id like :P1 and servo_service_service_id like :P2) as TotalAdjustments\n\nfrom servo_shifts where shift_id = :P1 \n\n",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.shift_id}}",
                "test": "202"
              },
              {
                "name": ":P2",
                "value": "{{$_GET.service_id}}",
                "test": "1"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "shift_id",
            "type": "number"
          },
          {
            "name": "TotalPaid",
            "type": "text"
          },
          {
            "name": "TotalOpenPaid",
            "type": "text"
          },
          {
            "name": "TotalOpenUnpaid",
            "type": "text"
          },
          {
            "name": "TotalSales",
            "type": "text"
          },
          {
            "name": "TotalAdjustments",
            "type": "text"
          }
        ],
        "type": "dbcustom_query"
      },
      {
        "name": "shift_sales_products",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT *, sum(order_item_quantity) as Volume, sum(order_item_price * order_item_quantity) as Total\nFROM servo_order_items\nLEFT JOIN servo_products ON servo_products.product_id = servo_order_items.servo_products_product_id \n\nLEFT JOIN servo_product_categories ON servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id \n\nLEFT JOIN servo_orders ON servo_orders.order_id = servo_order_items.servo_orders_order_id\nWHERE servo_orders.servo_shift_shift_id = :P1 /* {{$_GET.shift_id}} */ AND servo_orders.servo_service_service_id like :P2 /* {{$_GET.service_id}} */\n\ngroup by product_id\n",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.shift_id}}",
                "test": "202"
              },
              {
                "name": ":P2",
                "value": "{{$_GET.service_id}}",
                "test": "1"
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
            "name": "order_item_uom",
            "type": "file"
          },
          {
            "name": "order_item_uom_ref",
            "type": "number"
          },
          {
            "name": "order_item_uom_ref_multiple",
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
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
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
            "type": "text"
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
            "name": "order_pos",
            "type": "number"
          },
          {
            "name": "order_total_adjustment",
            "type": "text"
          },
          {
            "name": "Volume",
            "type": "text"
          },
          {
            "name": "Total",
            "type": "text"
          }
        ],
        "type": "dbcustom_query",
        "outputType": "array"
      },
      {
        "name": "shift_sales_categories",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT *, sum(order_item_quantity) as Volume, sum(order_item_price) as Total\nFROM servo_order_items\nLEFT JOIN servo_products ON servo_products.product_id = servo_order_items.servo_products_product_id \n\nLEFT JOIN servo_product_categories ON servo_product_categories.product_categories_id = servo_products.servo_product_category_product_category_id \n\nLEFT JOIN servo_orders ON servo_orders.order_id = servo_order_items.servo_orders_order_id\nWHERE servo_orders.servo_shift_shift_id = :P1 /* {{$_GET.shift_id}} */ AND servo_orders.servo_service_service_id like :P2 /* {{$_GET.service_id}} */\n\ngroup by product_categories_id",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.shift_id}}",
                "test": "202"
              },
              {
                "name": ":P2",
                "value": "{{$_GET.service_id}}",
                "test": "1"
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
            "name": "product_reference_uom",
            "type": "file"
          },
          {
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
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
            "type": "text"
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
            "name": "order_pos",
            "type": "number"
          },
          {
            "name": "order_total_adjustment",
            "type": "text"
          },
          {
            "name": "Volume",
            "type": "text"
          },
          {
            "name": "Total",
            "type": "text"
          }
        ],
        "type": "dbcustom_query"
      }
    ]
  }
}
JSON
);
?>