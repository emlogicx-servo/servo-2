<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "wallet_privilege_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_wallet_privilege",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_wallet_privileges",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "wallet_privilege_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.wallet_privilege_id}}",
                "data": {
                  "column": "wallet_privilege_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "wallet_privilege_id",
          "query": "delete from `servo_wallet_privileges` where `wallet_privilege_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.wallet_privilege_id}}",
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