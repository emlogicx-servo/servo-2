<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "transaction_id"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "transaction_status"
      },
      {
        "type": "number",
        "name": "transaction_id"
      },
      {
        "type": "number",
        "name": "transaction_user_received"
      },
      {
        "type": "datetime",
        "name": "transaction_time_received"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_wallet_transaction_received",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_status",
              "type": "text",
              "value": "Received"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_user_received",
              "type": "number",
              "value": "{{$_POST.transaction_user_received}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_time_received",
              "type": "datetime",
              "value": "{{$_POST.transaction_time_received}}"
            }
          ],
          "table": "servo_wallet_transactions",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "transaction_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.transaction_id}}",
                "data": {
                  "column": "transaction_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "transaction_id",
          "query": "update `servo_wallet_transactions` set `transaction_status` = ?, `transaction_user_received` = ?, `transaction_time_received` = ? where `transaction_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.transaction_user_received}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.transaction_time_received}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.transaction_id}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>