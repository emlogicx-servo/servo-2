<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  {
    "name": "purchasing_report_products_received",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "select product_name, po_item_quantity as 'quantity', sum(po_item_quantity * po_item_price) as 'Total Received' from servo_purchase_order_items\n\nleft join servo_products on product_id = po_product_id\nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\nleft join servo_vendors on vendor_id = servo_purchase_orders.servo_vendors_vendor_id\nwhere po_status = 'Received'\ngroup by product_name\n",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "product_name",
        "type": "text"
      },
      {
        "name": "quantity",
        "type": "text"
      },
      {
        "name": "Total Received",
        "type": "text"
      }
    ]
  },
  {
    "name": "purchasing_report_products_approved",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "select product_name, po_item_quantity as 'quantity', sum(po_item_quantity * po_item_price) as 'Total Approved' from servo_purchase_order_items\n\nleft join servo_products on product_id = po_product_id\nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\nleft join servo_vendors on vendor_id = servo_purchase_orders.servo_vendors_vendor_id\nwhere po_status = 'Approved'\ngroup by product_name\n",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "product_name",
        "type": "text"
      },
      {
        "name": "quantity",
        "type": "text"
      },
      {
        "name": "Total Approved",
        "type": "text"
      }
    ]
  },
  {
    "name": "purchasing_report_products_requested",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "select product_name, po_item_quantity as 'quantity', sum(po_item_quantity * po_item_price) as 'Total Requested' from servo_purchase_order_items\n\nleft join servo_products on product_id = po_product_id\nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\nleft join servo_vendors on vendor_id = servo_purchase_orders.servo_vendors_vendor_id\nwhere po_status = 'Requested'\ngroup by product_name\n",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "product_name",
        "type": "text"
      },
      {
        "name": "quantity",
        "type": "text"
      },
      {
        "name": "Total Requested",
        "type": "text"
      }
    ]
  }
]
JSON
);
?>