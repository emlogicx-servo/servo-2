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
      "table": "servo_department",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "department_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.department_id}}",
            "data": {
              "column": "department_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_department\nWHERE department_id = :P1 /* {{$_POST.department_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.department_id}}"
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