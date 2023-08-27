<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "service_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_service",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_services",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "service_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.service_id}}",
                "data": {
                  "column": "service_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "service_id",
          "query": "DELETE\nFROM servo_services\nWHERE service_id = :P1 /* {{$_POST.service_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.service_id}}"
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