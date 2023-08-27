<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "department_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_department_categories",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_department_categories"
          },
          "joins": [
            {
              "table": "servo_department",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_department",
                    "column": "department_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_department_categories",
                      "column": "department_id"
                    },
                    "operation": "="
                  }
                ]
              }
            },
            {
              "table": "servo_product_categories",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_product_categories",
                    "column": "product_categories_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_department_categories",
                      "column": "category_id"
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT *\nFROM servo_department_categories\nINNER JOIN servo_department ON (servo_department.department_id = servo_department_categories.department_id) INNER JOIN servo_product_categories ON (servo_product_categories.product_categories_id = servo_department_categories.category_id)\nWHERE servo_department_categories.department_id = :P1 /* {{$_GET.department_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.department_id}}"
            }
          ],
          "orders": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_department_categories.department_id",
                "field": "servo_department_categories.department_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.department_id}}",
                "data": {
                  "table": "servo_department_categories",
                  "column": "department_id",
                  "type": "number"
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
          "name": "id"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "number",
          "name": "category_id"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "number",
          "name": "product_categories_id"
        },
        {
          "type": "text",
          "name": "product_category_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>