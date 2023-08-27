<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "user_profile_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_user_profile",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "user_profile_id",
                "field": "user_profile_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.user_profile_id}}",
                "data": {
                  "column": "user_profile_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "DELETE\nFROM servo_user_profile\nWHERE user_profile_id = :P1 /* {{$_POST.user_profile_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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