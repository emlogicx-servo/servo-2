<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "wallet_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "custom_wallet_report_general",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select (select sum(transaction_amount) from servo_wallet_transactions where transaction_status = 'Pending' AND delete_status ='active') as Pending,\n\n (select sum(transaction_amount) from servo_wallet_transactions where  transaction_status = 'Approved' AND delete_status ='active') as Approved,\n\n(select sum(transaction_amount) from servo_wallet_transactions where  transaction_status = 'Received' AND delete_status ='active') as Received,\n\n(select sum(transaction_amount) from servo_wallet_transactions where  transaction_status = 'Received' AND delete_status ='active' and transaction_type = 'Deposit') as TotalDeposits,\n\n(select sum(transaction_amount) from servo_wallet_transactions where  transaction_status = 'Received' AND delete_status ='active' and transaction_type = 'Transfer') as TotalTransfersOut,\n\n(select sum(transaction_amount) from servo_wallet_transactions where  transaction_status = 'Received' AND delete_status ='active' and transaction_type = 'Transfer') as TotalTransfersIn,\n\n(select sum(transaction_amount) from servo_wallet_transactions where  transaction_status = 'Received' AND delete_status ='active' and transaction_type = 'Payment') as TotalPayments\n\n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.wallet_id}}",
              "test": "1"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "Pending",
          "type": "text"
        },
        {
          "name": "Approved",
          "type": "text"
        },
        {
          "name": "Received",
          "type": "text"
        },
        {
          "name": "TotalDeposits",
          "type": "text"
        },
        {
          "name": "TotalTransfersOut",
          "type": "text"
        },
        {
          "name": "TotalTransfersIn",
          "type": "text"
        },
        {
          "name": "TotalPayments",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>