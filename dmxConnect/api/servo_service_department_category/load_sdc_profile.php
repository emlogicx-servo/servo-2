<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "department_id"
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
      "name": "query_load_sdc_profile",
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
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_service_department_category.sdc_department_id",
                "field": "servo_service_department_category.sdc_department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department_id}}",
                "data": {
                  "table": "servo_service_department_category",
                  "column": "sdc_department_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "department_id",
                    "inTable": "servo_department",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "sdc_department_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_service_department_category AS servo_service_department_category\nWHERE sdc_department_id = :P1 /* {{$_GET.department_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.department_id}}"
            }
          ]
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
        },
        {
          "type": "text",
          "name": "sdc_code"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>