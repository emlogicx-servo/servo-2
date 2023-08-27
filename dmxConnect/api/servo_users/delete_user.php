<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
      "table": "servo_user",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "user_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.user_id}}",
            "data": {
              "column": "user_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_user\nWHERE user_id = :P1 /* {{$_POST.user_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.user_id}}"
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