<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "query_list_customer_debt_totals",
  "module": "dbupdater",
  "action": "custom",
  "options": {
    "connection": "servodb",
    "sql": {
      "query": "select customer_id, customer_first_name, customer_last_name, customer_phone_number, customer_picture, customer_address,\n((select (sum((order_item_price * order_item_quantity) * ((100 - order_discount)/100) * ((100 - coverage_percentage)/100))) from servo_order_items inner join servo_orders on (order_id = servo_orders_order_id) where order_customer = customer_id) \n \n - \n(select IFNULL(sum(transaction_amount),0) from servo_customer_cash_transaction where servo_customer_cash_transaction.customer_id = servo_customers.customer_id AND transaction_type = \"Settlement\")) as TotalDebt\n\nfrom servo_customers \n\ngroup by TotalDebt \norder by TotalDebt Desc\n\n\n",
      "params": []
    }
  },
  "meta": [
    {
      "name": "customer_id",
      "type": "number"
    },
    {
      "name": "customer_first_name",
      "type": "file"
    },
    {
      "name": "customer_last_name",
      "type": "file"
    },
    {
      "name": "customer_phone_number",
      "type": "text"
    },
    {
      "name": "customer_picture",
      "type": "text"
    },
    {
      "name": "customer_address",
      "type": "file"
    },
    {
      "name": "TotalDebt",
      "type": "text"
    }
  ],
  "output": true
}
JSON
);
?>