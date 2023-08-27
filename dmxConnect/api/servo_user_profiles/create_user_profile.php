<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "user_profile_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_user_profile",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_user_profile",
              "column": "user_profile_name",
              "type": "text",
              "value": "{{$_POST.user_profile_name}}"
            }
          ],
          "table": "servo_user_profile",
          "returning": "user_profile_id",
          "query": "INSERT INTO servo_user_profile\n(user_profile_name) VALUES (:P1 /* {{$_POST.user_profile_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_profile_name}}"
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