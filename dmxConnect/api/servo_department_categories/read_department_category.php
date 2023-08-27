<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "department_category_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_department_category",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_department_categories"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_department_categories.id",
                "field": "servo_department_categories.id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department_category_id}}",
                "data": {
                  "table": "servo_department_categories",
                  "column": "id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_department_categories\nWHERE id = :P1 /* {{$_GET.department_category_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.department_category_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "id"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "number",
          "name": "category_id"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>