<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "branch_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "queryReadBranch",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_branches"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_branches.branch_id",
                "field": "servo_branches.branch_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.branch_id}}",
                "data": {
                  "table": "servo_branches",
                  "column": "branch_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_branches\nWHERE branch_id = :P1 /* {{$_GET.branch_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.branch_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "branch_id"
        },
        {
          "type": "text",
          "name": "branch_name"
        },
        {
          "type": "datetime",
          "name": "branch_date_registered"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>