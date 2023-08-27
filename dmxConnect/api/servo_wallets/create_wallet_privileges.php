<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ],
    "$_POST": [
      {
        "type": "number",
        "name": "wallet_privilege_wallet_id"
      },
      {
        "type": "number",
        "name": "wallet_privilege_user_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_wallet_privillege",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_wallet_id",
              "type": "number",
              "value": "{{$_POST.wallet_privilege_wallet_id}}"
            },
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_user_id",
              "type": "number",
              "value": "{{$_POST.wallet_privilege_user_id}}"
            }
          ],
          "table": "servo_wallet_privileges",
          "returning": "wallet_privilege_id",
          "query": "insert into `servo_wallet_privileges` (`wallet_privilege_user_id`, `wallet_privilege_wallet_id`) values (?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_wallet_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_user_id}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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