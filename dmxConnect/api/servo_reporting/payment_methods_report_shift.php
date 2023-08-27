<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "shift"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "payment_methods_report_shift",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select SUM(transaction_amount) as TotalPayments, payment_method_name as Method from servo_customer_cash_transaction \n\nleft join servo_orders on (servo_customer_cash_transaction.transaction_order = servo_orders.order_id)\n\nleft join servo_payment_methods on (transaction_payment_method = payment_method_id)\n\nwhere transaction_type = 'Settlement' and servo_shift_shift_id = :P4\n\ngroup by servo_payment_methods.payment_method_name",
          "params": [
            {
              "name": ":P4",
              "value": "{{$_GET.shift}}",
              "test": "36"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "TotalPayments",
          "type": "text"
        },
        {
          "name": "Method",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>