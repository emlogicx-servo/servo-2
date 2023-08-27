<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  {
    "name": "purchasing_report_vendors_received",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "select vendor_name, sum(po_item_quantity * po_item_price) as 'Total Received' from servo_purchase_order_items\n\nleft join servo_products on product_id = po_product_id\nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\nleft join servo_vendors on vendor_id = servo_purchase_orders.servo_vendors_vendor_id\nwhere po_status = 'Received'\ngroup by vendor_name\n",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "vendor_name",
        "type": "text"
      },
      {
        "name": "Total Received",
        "type": "text"
      }
    ],
    "outputType": "array"
  },
  {
    "name": "purchasing_report_vendors_approved",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "select vendor_name, sum(po_item_quantity * po_item_price) as 'Total Approved' from servo_purchase_order_items\n\nleft join servo_products on product_id = po_product_id\nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\nleft join servo_vendors on vendor_id = servo_purchase_orders.servo_vendors_vendor_id\nwhere po_status = 'Approved'\ngroup by vendor_name\n",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "vendor_name",
        "type": "text"
      },
      {
        "name": "Total Approved",
        "type": "text"
      }
    ],
    "outputType": "array"
  },
  {
    "name": "purchasing_report_vendors_requested",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "select vendor_name, sum(po_item_quantity * po_item_price) as 'Total Requested' from servo_purchase_order_items\n\nleft join servo_products on product_id = po_product_id\nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id\nleft join servo_vendors on vendor_id = servo_purchase_orders.servo_vendors_vendor_id\nwhere po_status = 'Requested'\ngroup by vendor_name\n",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "vendor_name",
        "type": "text"
      },
      {
        "name": "Total Requested",
        "type": "text"
      }
    ],
    "outputType": "array"
  }
]
JSON
);
?>