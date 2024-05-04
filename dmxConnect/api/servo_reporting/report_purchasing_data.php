<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "department_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "purchasing_report_data",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select \n(select (sum(po_item_quantity * po_item_price) * ((100 - po_discount)/100)) from servo_purchase_orders left join servo_purchase_order_items on servo_purchase_orders.po_id = servo_purchase_order_items.po_id where po_status = 'Requested' and servo_departments_department_id like :P1) as TotalRequested,\n\n(select (sum(po_item_quantity * po_item_price) * ((100 - po_discount)/100)) from servo_purchase_orders left join servo_purchase_order_items on servo_purchase_orders.po_id = servo_purchase_order_items.po_id where po_status = 'Approved' and servo_departments_department_id like :P1) as 'TotalOrdered',\n\n(select (sum(po_item_quantity * po_item_price) * ((100 - po_discount)/100)) from servo_purchase_orders left join servo_purchase_order_items on servo_purchase_orders.po_id = servo_purchase_order_items.po_id where po_status = 'Received' and servo_departments_department_id like :P1) as 'TotalPurchased',\n\n(select sum(transaction_amount) from servo_vendor_cash_transaction left join servo_purchase_orders on servo_purchase_orders.po_id = transaction_order  and servo_departments_department_id like :P1) as 'TotalPaid' \n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.department_id}}",
              "test": "%"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "TotalRequested",
          "type": "text"
        },
        {
          "name": "TotalOrdered",
          "type": "text"
        },
        {
          "name": "TotalPurchased",
          "type": "text"
        },
        {
          "name": "TotalPaid",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>