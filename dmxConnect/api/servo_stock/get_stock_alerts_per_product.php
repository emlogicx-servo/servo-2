<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "custom_get_stock_alerts_per_product",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_name, ((select COALESCE(sum(po_item_quantity), 0) from servo_purchase_order_items \nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id \nwhere po_status = \"Received\" and po_product_id = product_id)  -\n\n((select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status = 'Adjustment') +\n\n(select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status IN ('Paid', 'Credit')))) as TotalStock\n\nfrom servo_products \n \ngroup by product_name\n",
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
          "name": "TotalStock",
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