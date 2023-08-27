<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "query_product_sale_credit_total",
  "module": "dbupdater",
  "action": "custom",
  "options": {
    "connection": "servodb",
    "sql": {
      "query": "select SUM(order_item_quantity * order_item_price) as AMOUNT, SUM(order_item_quantity) as QUANTITY\n\nfrom servo_order_items\n\nleft join \nservo_orders on (servo_order_items.servo_orders_order_id = servo_orders.order_id)\n\nWHERE order_status = 'Credit'\n",
      "params": []
    }
  },
  "output": true,
  "meta": [
    {
      "name": "AMOUNT",
      "type": "text"
    },
    {
      "name": "QUANTITY",
      "type": "text"
    }
  ],
  "outputType": "array"
}
JSON
);
?>