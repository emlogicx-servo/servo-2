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
      "name": "custom_get_stock_alerts",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select product_name, product_id, product_min_stock, ((select COALESCE(sum(po_item_quantity), 0) from servo_purchase_order_items \nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id \nwhere po_status = \"Received\" and po_product_id = product_id)  -\n\n((select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status = 'Adjustment') +\n\n(select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status IN ('Paid', 'Credit')))) as TotalStock\n\nfrom servo_products where product_type = 'Store' or 'Stock'\ngroup by product_name\nhaving TotalStock  <= product_min_stock",
          "params": [
            {
              "name": ":P2",
              "value": "{{$_GET.totalstock}}",
              "test": "1"
            },
            {
              "name": ":P1",
              "value": "{{$_GET.product_id}}",
              "test": "48"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "product_id",
          "type": "number"
        },
        {
          "name": "product_min_stock",
          "type": "number"
        },
        {
          "name": "TotalStock",
          "type": "number"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>