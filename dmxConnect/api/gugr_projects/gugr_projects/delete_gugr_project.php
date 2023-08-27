<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "project_id"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "project_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_gugr_project",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_projects",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "project_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.project_id}}",
                "data": {
                  "column": "project_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "project_id",
          "query": "DELETE\nFROM servo_projects\nWHERE project_id = :P1 /* {{$_POST.project_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.project_id}}",
              "test": ""
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