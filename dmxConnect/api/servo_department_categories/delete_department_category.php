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
      "table": "servo_department_categories",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.id}}",
            "data": {
              "column": "id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_department_categories\nWHERE id = :P1 /* {{$_POST.id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.id}}"
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