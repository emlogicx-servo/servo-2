<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "service_department_category_id"
      },
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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_service_department_category",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
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
            }
          ],
          "table": "servo_service_department_category",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "service_department_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.service_department_category_id}}",
                "data": {
                  "column": "service_department_category_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "service_department_category_id",
          "query": "UPDATE servo_service_department_category\nSET sdc_service_id = :P1 /* {{$_POST.sdc_service_id}} */, sdc_category_id = :P2 /* {{$_POST.sdc_category_id}} */, sdc_department_id = :P3 /* {{$_POST.sdc_department_id}} */\nWHERE service_department_category_id = :P4 /* {{$_POST.service_department_category_id}} */",
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
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
              "value": "{{$_POST.service_department_category_id}}"
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