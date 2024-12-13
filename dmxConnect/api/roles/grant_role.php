<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/roles.php",
      "linkedForm": "role_grant_form"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "role_id",
        "name": "role_id"
      },
      {
        "type": "text",
        "fieldName": "user_id",
        "name": "user_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "db",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_role_user",
              "column": "user_id",
              "type": "number",
              "value": "{{$_POST.user_id}}"
            },
            {
              "table": "servo_role_user",
              "column": "role_id",
              "type": "number",
              "value": "{{$_POST.role_id}}"
            }
          ],
          "table": "servo_role_user",
          "returning": "id",
          "query": "insert into `servo_role_user` (`role_id`, `user_id`) values (?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.role_id}}",
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