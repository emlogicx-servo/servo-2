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
        "type": "datetime",
        "name": "delete_date"
      },
      {
        "type": "number",
        "name": "delete_user"
      },
      {
        "type": "number",
        "name": "transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_transaction_status_deleted",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_wallet_transactions",
              "column": "delete_status",
              "type": "text",
              "value": "deleted"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "delete_date",
              "type": "datetime",
              "value": "{{$_POST.delete_date}}"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "delete_user",
              "type": "number",
              "value": "{{$_POST.delete_user}}"
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
          "query": "UPDATE servo_wallet_transactions\nSET delete_status = 'deleted', delete_date = :P1 /* {{$_POST.delete_date}} */, delete_user = :P2 /* {{$_POST.delete_user}} */\nWHERE transaction_id = :P3 /* {{$_POST.transaction_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.delete_date}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.delete_user}}",
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