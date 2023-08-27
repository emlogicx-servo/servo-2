<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
        "name": "department_category_code"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_department_categories",
              "column": "department_id",
              "type": "number",
              "value": "{{$_POST.department_id}}"
            },
            {
              "table": "servo_department_categories",
              "column": "category_id",
              "type": "number",
              "value": "{{$_POST.category_id}}"
            },
            {
              "table": "servo_department_categories",
              "column": "department_category_code",
              "type": "text",
              "value": "{{$_POST.department_category_code}}"
            }
          ],
          "table": "servo_department_categories",
          "returning": "id",
          "query": "INSERT INTO servo_department_categories\n(department_id, category_id, department_category_code) VALUES (:P1 /* {{$_POST.department_id}} */, :P2 /* {{$_POST.category_id}} */, :P3 /* {{$_POST.department_category_code}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.department_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.category_id}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.department_category_code}}"
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