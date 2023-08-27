<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_shift",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_shifts",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "shift_id",
                "field": "shift_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.shift_id}}",
                "data": {
                  "column": "shift_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "DELETE\nFROM servo_shifts\nWHERE shift_id = :P1 /* {{$_POST.shift_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.shift_id}}"
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