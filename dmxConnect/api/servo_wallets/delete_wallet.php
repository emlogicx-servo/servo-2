<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "wallet_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_wallet",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_wallets",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "wallet_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.wallet_id}}",
                "data": {
                  "column": "wallet_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "wallet_id",
          "query": "delete from `servo_wallets` where `wallet_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.wallet_id}}",
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