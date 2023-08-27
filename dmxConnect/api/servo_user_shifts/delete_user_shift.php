<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete_user_shift",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
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
      "query": "DELETE\nFROM servo_user_shifts\nWHERE user_shift_id = :P1 /* {{$_POST.user_shift_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
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
JSON
);
?>