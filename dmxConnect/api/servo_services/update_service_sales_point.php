<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "service_id"
      },
      {
        "type": "number",
        "name": "servo_service_sales_point"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_service_sales_point",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_services",
              "column": "servo_service_sales_point",
              "type": "number",
              "value": "{{$_POST.servo_service_sales_point}}"
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
          "query": "UPDATE servo_services\nSET servo_service_sales_point = :P1 /* {{$_POST.servo_service_sales_point}} */\nWHERE service_id = :P2 /* {{$_POST.service_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.servo_service_sales_point}}"
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