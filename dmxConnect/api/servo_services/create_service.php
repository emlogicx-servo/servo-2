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
        "name": "servo_service_sales_point"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert_service",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_services",
              "column": "service_name",
              "type": "number",
              "value": "{{$_POST.service_name}}"
            },
            {
              "table": "servo_services",
              "column": "servo_service_sales_point",
              "type": "number",
              "value": "{{$_POST.servo_service_sales_point}}"
            }
          ],
          "table": "servo_services",
          "returning": "service_id",
          "query": "INSERT INTO servo_services\n(service_name, servo_service_sales_point) VALUES (:P1 /* {{$_POST.service_name}} */, :P2 /* {{$_POST.servo_service_sales_point}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.service_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.servo_service_sales_point}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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