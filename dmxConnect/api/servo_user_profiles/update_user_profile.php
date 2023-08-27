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
      },
      {
        "type": "number",
        "name": "user_profile_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "updateUserProfile",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_user_profile",
              "column": "user_profile_name",
              "type": "text",
              "value": "{{$_POST.user_profile_name}}"
            }
          ],
          "table": "servo_user_profile",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "user_profile_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.user_profile_id}}",
                "data": {
                  "column": "user_profile_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_user_profile\nSET user_profile_name = :P1 /* {{$_POST.user_profile_name}} */\nWHERE user_profile_id = :P2 /* {{$_POST.user_profile_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_profile_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.user_profile_id}}"
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