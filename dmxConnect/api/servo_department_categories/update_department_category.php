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
        "type": "number",
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_update_department_category",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
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
            }
          ],
          "table": "servo_department_categories",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.id}}",
                "data": {
                  "column": "id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_department_categories\nSET department_id = :P1 /* {{$_POST.department_id}} */, category_id = :P2 /* {{$_POST.category_id}} */\nWHERE id = :P3 /* {{$_POST.id}} */",
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
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.id}}"
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