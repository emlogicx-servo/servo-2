<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "service_name"
      },
      {
        "type": "number",
        "name": "service_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_service_name",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_services",
              "column": "service_name",
              "type": "number",
              "value": "{{$_POST.service_name}}"
            }
          ],
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
          "query": "UPDATE servo_services\nSET service_name = :P1 /* {{$_POST.service_name}} */\nWHERE service_id = :P2 /* {{$_POST.service_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.service_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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