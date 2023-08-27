<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "sdc_service_id"
      },
      {
        "type": "number",
        "name": "sdc_category_id"
      },
      {
        "type": "number",
        "name": "sdc_department_id"
      },
      {
        "type": "text",
        "name": "sdc_code"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert_service_department_category",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_service_department_category",
              "column": "sdc_service_id",
              "type": "number",
              "value": "{{$_POST.sdc_service_id}}"
            },
            {
              "table": "servo_service_department_category",
              "column": "sdc_category_id",
              "type": "number",
              "value": "{{$_POST.sdc_category_id}}"
            },
            {
              "table": "servo_service_department_category",
              "column": "sdc_department_id",
              "type": "number",
              "value": "{{$_POST.sdc_department_id}}"
            },
            {
              "table": "servo_service_department_category",
              "column": "sdc_code",
              "type": "text",
              "value": "{{$_POST.sdc_code}}"
            }
          ],
          "table": "servo_service_department_category",
          "returning": "service_department_category_id",
          "query": "INSERT INTO servo_service_department_category\n(sdc_service_id, sdc_category_id, sdc_department_id, sdc_code) VALUES (:P1 /* {{$_POST.sdc_service_id}} */, :P2 /* {{$_POST.sdc_category_id}} */, :P3 /* {{$_POST.sdc_department_id}} */, :P4 /* {{$_POST.sdc_code}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.sdc_service_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.sdc_category_id}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.sdc_department_id}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.sdc_code}}"
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