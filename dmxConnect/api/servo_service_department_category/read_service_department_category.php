<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "service_department_category_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_service_department_category",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_service_department_category",
            "alias": "servo_service_department_category"
          },
          "primary": "service_department_category_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_service_department_category AS servo_service_department_category\nWHERE service_department_category_id = :P1 /* {{$_GET.service_department_category_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.service_department_category_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_service_department_category.service_department_category_id",
                "field": "servo_service_department_category.service_department_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.service_department_category_id}}",
                "data": {
                  "table": "servo_service_department_category",
                  "column": "service_department_category_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "service_department_category_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
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
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>