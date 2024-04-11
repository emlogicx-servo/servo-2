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
        "name": "transaction_user_approved"
      },
      {
        "type": "number",
        "name": "transaction_id"
      },
      {
        "type": "datetime",
        "name": "transaction_time_approved"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_wallet_transaction_approved",
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
              "value": "Approved"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_user_approved",
              "type": "number",
              "value": "{{$_POST.transaction_user_approved}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_time_approved",
              "type": "datetime",
              "value": "{{$_POST.transaction_time_approved}}"
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
          "query": "update `servo_wallet_transactions` set `transaction_status` = ?, `transaction_user_approved` = ?, `transaction_time_approved` = ? where `transaction_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.transaction_user_approved}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.transaction_time_approved}}",
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