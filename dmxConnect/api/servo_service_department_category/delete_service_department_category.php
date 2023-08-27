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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_service_department_category",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
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
          "query": "DELETE\nFROM servo_service_department_category\nWHERE service_department_category_id = :P1 /* {{$_POST.service_department_category_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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