<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/roles.php",
      "linkedForm": "role_revoke_form"
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
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "db",
        "sql": {
          "type": "delete",
          "table": "servo_role_user",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "user_id",
                "field": "user_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.user_id}}",
                "data": {
                  "column": "user_id"
                },
                "operation": "="
              },
              {
                "id": "role_id",
                "field": "role_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.role_id}}",
                "data": {
                  "column": "role_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "id",
          "query": "delete from `servo_role_user` where `user_id` = ? and `role_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.user_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.role_id}}",
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