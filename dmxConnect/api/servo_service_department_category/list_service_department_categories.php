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
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_service_department_category",
            "alias": "servo_service_department_category"
          },
          "primary": "service_department_category_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_service_department_category AS servo_service_department_category\nWHERE sdc_service_id = :P1 /* {{$_GET.service_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.service_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_service_department_category.sdc_service_id",
                "field": "servo_service_department_category.sdc_service_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.service_id}}",
                "data": {
                  "table": "servo_service_department_category",
                  "column": "sdc_service_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": false,
                    "references": "service_id",
                    "inTable": "servo_services",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "sdc_service_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        },
        "connection": "servodb"
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
      "outputType": "array"
    }
  }
}
JSON
);
?>