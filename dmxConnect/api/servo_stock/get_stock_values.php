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
      "name": "getStockValues",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select servo_products_product_id, product_name, sum(order_item_quantity) as O, \n\n(select sum(order_item_quantity) from servo_order_items inner join servo_orders on order_id = servo_orders_order_id \nwhere order_status = 'Adjustment' and product_id = servo_products_product_id) as AO, \n\n(select sum(po_item_quantity) from servo_purchase_order_items inner join servo_purchase_orders on servo_purchase_order_items.po_id = servo_purchase_orders.po_id where po_status = 'Received' and po_product_id = servo_products_product_id) as  PO\n\nfrom servo_order_items \ninner join servo_products on product_id = servo_products_product_id \ninner join servo_orders on order_id = servo_orders_order_id \nwhere order_status = \"Paid\" \ngroup by servo_products_product_id",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "name": "servo_products_product_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "O",
          "type": "text"
        },
        {
          "name": "AO",
          "type": "text"
        },
        {
          "name": "PO",
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