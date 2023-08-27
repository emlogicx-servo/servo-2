<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "shift_start"
      },
      {
        "type": "datetime",
        "name": "shift_stop"
      },
      {
        "type": "text",
        "name": "shift_status"
      },
      {
        "type": "number",
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_shifts",
              "column": "shift_start",
              "type": "datetime",
              "value": "{{$_POST.shift_start}}"
            },
            {
              "table": "servo_shifts",
              "column": "shift_stop",
              "type": "datetime",
              "value": "{{$_POST.shift_stop}}"
            },
            {
              "table": "servo_shifts",
              "column": "shift_status",
              "type": "text",
              "value": "{{$_POST.shift_status}}"
            }
          ],
          "table": "servo_shifts",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.shift_id}}",
                "data": {
                  "column": "shift_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_shifts\nSET shift_start = :P1 /* {{$_POST.shift_start}} */, shift_stop = :P2 /* {{$_POST.shift_stop}} */, shift_status = :P3 /* {{$_POST.shift_status}} */\nWHERE shift_id = :P4 /* {{$_POST.shift_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.shift_start}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.shift_stop}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.shift_status}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
              "value": "{{$_POST.shift_id}}"
            }
          ],
          "returning": "shift_id"
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