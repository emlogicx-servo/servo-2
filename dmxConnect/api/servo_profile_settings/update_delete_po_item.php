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
        "name": "delete_po_item"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_delete_po_item",
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
              "column": "delete_po_item",
              "type": "text",
              "value": "{{$_POST.delete_po_item}}"
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
          "query": "UPDATE servo_profile_settings\nSET profile_settings_id = :P1 /* {{$_POST.profile_settings_id}} */, delete_po_item = :P2 /* {{$_POST.delete_po_item}} */\nWHERE profile_settings_id = :P3 /* {{$_POST.profile_settings_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.profile_settings_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.delete_po_item}}"
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