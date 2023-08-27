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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
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
          "query": "select po_product_id, product_name, sum(po_item_quantity) as TotalPurchased,\n\n(select sum(po_item_quantity) from servo_purchase_order_items left join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id where po_type = 'Transfer' AND po_status = 'Received' and product_id = po_product_id) as TotalTransfered, \n\n(select sum(order_item_quantity) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere order_status = 'Adjustment' and product_id = servo_products_product_id) as TotalAdjusted,\n\n(select sum(order_item_quantity) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere order_status IN ('Paid', 'Credit') and product_id = servo_products_product_id) as TotalSold,\n\n(select sum(order_item_quantity) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere order_item_status != 'Delivered' and product_id = servo_products_product_id) as ReservedStock,\n\n(select sum(order_item_quantity) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere order_item_status = 'Delivered' and product_id = servo_products_product_id) as DeliveredStock\n\nfrom servo_purchase_order_items \nleft join servo_products on product_id = po_product_id \nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id \nwhere po_status = \"Received\" and po_type = 'Purchase'\ngroup by product_name\nlimit :P2,:P1",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.limit}}",
              "test": "25"
            },
            {
              "name": ":P2",
              "value": "{{$_GET.offset}}",
              "test": "1"
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
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "TotalPurchased",
          "type": "text"
        },
        {
          "name": "TotalTransfered",
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