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
      },
      {
        "type": "text",
        "name": "wallet_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_users_not_in_wallet",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "SELECT servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username\nFROM servo_user\nWHERE servo_user.user_id NOT IN (select wallet_privilege_user_id from servo_wallet_privileges where wallet_privilege_wallet_id = :P1)",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.wallet_id}}",
              "test": "2"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "user_id",
          "type": "number"
        },
        {
          "name": "user_fname",
          "type": "text"
        },
        {
          "name": "user_lname",
          "type": "text"
        },
        {
          "name": "user_username",
          "type": "text"
        }
      ],
      "type": "dbcustom_query"
    }
  }
}
JSON
);
?>