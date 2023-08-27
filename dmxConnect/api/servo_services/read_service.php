<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "service_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_service",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_services",
            "alias": "servo_services"
          },
          "primary": "service_id",
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_services.service_id",
                "field": "servo_services.service_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.service_id}}",
                "data": {
                  "table": "servo_services",
                  "column": "service_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "service_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_services AS servo_services\nWHERE service_id = :P1 /* {{$_GET.service_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.service_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "service_id"
        },
        {
          "type": "number",
          "name": "service_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>