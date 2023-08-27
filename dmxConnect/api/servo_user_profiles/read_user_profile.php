<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "user_profile_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "readUserProfile",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_user_profile",
              "column": "user_profile_id"
            },
            {
              "table": "servo_user_profile",
              "column": "user_profile_name"
            }
          ],
          "table": {
            "name": "servo_user_profile"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_user_profile.user_profile_id",
                "field": "servo_user_profile.user_profile_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.user_profile_id}}",
                "data": {
                  "table": "servo_user_profile",
                  "column": "user_profile_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT user_profile_id, user_profile_name\nFROM servo_user_profile\nWHERE user_profile_id = :P1 /* {{$_GET.user_profile_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.user_profile_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "user_profile_id"
        },
        {
          "type": "text",
          "name": "user_profile_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>