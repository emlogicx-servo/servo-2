<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "profile_settings_id"
      },
      {
        "type": "text",
        "name": "create_order"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_create_order",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_profile_settings",
              "column": "profile_settings_id",
              "type": "number",
              "value": "{{$_POST.profile_settings_id}}"
            },
            {
              "table": "servo_profile_settings",
              "column": "create_order",
              "type": "text",
              "value": "{{$_POST.create_order}}"
            }
          ],
          "table": "servo_profile_settings",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "profile_settings_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.profile_settings_id}}",
                "data": {
                  "column": "profile_settings_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "profile_settings_id",
          "query": "UPDATE servo_profile_settings\nSET profile_settings_id = :P1 /* {{$_POST.profile_settings_id}} */, create_order = :P2 /* {{$_POST.create_order}} */\nWHERE profile_settings_id = :P3 /* {{$_POST.profile_settings_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.profile_settings_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.create_order}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.profile_settings_id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ],
      "output": true
    }
  }
}
JSON
);
?>