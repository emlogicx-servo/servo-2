<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "time_checkin"
      },
      {
        "type": "number",
        "name": "user_shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_user_shift",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_user_shifts",
              "column": "time_checkin",
              "type": "datetime",
              "value": "{{$_POST.time_checkin}}"
            },
            {
              "table": "servo_user_shifts",
              "column": "user_shift_id",
              "type": "number",
              "value": "{{$_POST.user_shift_id}}"
            }
          ],
          "table": "servo_user_shifts",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "user_shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.user_shift_id}}",
                "data": {
                  "column": "user_shift_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_user_shifts\nSET time_checkin = :P1 /* {{$_POST.time_checkin}} */, user_shift_id = :P2 /* {{$_POST.user_shift_id}} */\nWHERE user_shift_id = :P3 /* {{$_POST.user_shift_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.time_checkin}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.user_shift_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.user_shift_id}}"
            }
          ],
          "returning": "user_shift_id"
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