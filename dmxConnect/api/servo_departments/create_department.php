<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "department_name"
      },
      {
        "type": "number",
        "name": "servo_product_categories_product_categories_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_department",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_department",
              "column": "department_name",
              "type": "text",
              "value": "{{$_POST.department_name}}"
            }
          ],
          "table": "servo_department",
          "returning": "department_id",
          "query": "INSERT INTO servo_department\n(department_name) VALUES (:P1 /* {{$_POST.department_name}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.department_name}}"
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