<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "po_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_purchase_order_totals",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n(select (sum((po_item_price * po_item_quantity) * ((100 - po_discount)/100))) from servo_purchase_order_items inner join servo_purchase_orders on (servo_purchase_orders.po_id = servo_purchase_order_items.po_id) where servo_purchase_orders.po_id = :P1) as 'PO Total',\n\n(select sum(transaction_amount) from servo_vendor_cash_transaction where transaction_order = :P1) as 'PO Total Paid'",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.po_id}}",
              "test": "35"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "PO Total",
          "type": "text"
        },
        {
          "name": "PO Total Paid",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>