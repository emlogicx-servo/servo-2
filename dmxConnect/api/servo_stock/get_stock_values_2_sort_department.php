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
    ]
  },
  "exec": {
    "steps": {
      "name": "getStockValues2",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select po_product_id, product_name, department_name, sum(po_item_quantity) as TotalPurchased, \n\n(select sum(order_item_quantity) from servo_order_items inner join servo_orders on order_id = servo_orders_order_id \nwhere order_status = 'Adjustment' and product_id = servo_products_product_id) as TotalAdjusted,\n\n(select sum(order_item_quantity) from servo_order_items inner join servo_orders on order_id = servo_orders_order_id \nwhere order_status IN ('Paid', 'Credit') and product_id = servo_products_product_id) as TotalSold\n\nfrom servo_purchase_order_items \n\ninner join servo_products on product_id = po_product_id \n\ninner join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id \n\ninner join servo_department on department_id = servo_departments_department_id\n\nwhere po_status = \"Received\" \ngroup by servo_departments_department_id",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "name": "po_product_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "department_name",
          "type": "text"
        },
        {
          "name": "TotalPurchased",
          "type": "text"
        },
        {
          "name": "TotalAdjusted",
          "type": "text"
        },
        {
          "name": "TotalSold",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>