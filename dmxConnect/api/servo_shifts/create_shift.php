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
        "type": "boolean",
        "name": "shift_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert_shift",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
              "type": "boolean",
              "value": "{{$_POST.shift_status}}"
            }
          ],
          "table": "servo_shifts",
          "returning": "shift_id",
          "query": "INSERT INTO servo_shifts\n(shift_start, shift_stop, shift_status) VALUES (:P1 /* {{$_POST.shift_start}} */, :P2 /* {{$_POST.shift_stop}} */, :P3 /* {{$_POST.shift_status}} */)",
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