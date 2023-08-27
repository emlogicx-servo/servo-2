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
        "name": "transaction_note"
      },
      {
        "type": "number",
        "name": "transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_wallet_transaction_note",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_note",
              "type": "text",
              "value": "{{$_POST.transaction_note}}"
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
          "query": "UPDATE servo_wallet_transactions\nSET transaction_note = :P1 /* {{$_POST.transaction_note}} */\nWHERE transaction_id = :P2 /* {{$_POST.transaction_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.transaction_note}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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