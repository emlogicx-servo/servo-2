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
      "table": "servo_branches",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "branch_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.branch_id}}",
            "data": {
              "column": "branch_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_branches\nWHERE branch_id = :P1 /* {{$_POST.branch_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.branch_id}}"
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