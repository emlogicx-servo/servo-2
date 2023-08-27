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
      "table": "servo_customer_table",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "table_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.table_id}}",
            "data": {
              "column": "table_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_customer_table\nWHERE table_id = :P1 /* {{$_POST.table_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.table_id}}"
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