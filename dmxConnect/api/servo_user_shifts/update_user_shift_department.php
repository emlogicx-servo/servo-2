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
      },
      {
        "type": "number",
        "name": "user_shift_department_id"
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
              "column": "user_shift_id",
              "type": "number",
              "value": "{{$_POST.user_shift_id}}"
            },
            {
              "table": "servo_user_shifts",
              "column": "user_shift_department_id",
              "type": "number",
              "value": "{{$_POST.user_shift_department_id}}"
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
          "query": "UPDATE servo_user_shifts\nSET user_shift_id = :P1 /* {{$_POST.user_shift_id}} */, user_shift_department_id = :P2 /* {{$_POST.user_shift_department_id}} */\nWHERE user_shift_id = :P3 /* {{$_POST.user_shift_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.user_shift_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.user_shift_department_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.user_shift_id}}"
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