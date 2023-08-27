<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "branch_name"
      },
      {
        "type": "datetime",
        "name": "branch_date_registered"
      },
      {
        "type": "number",
        "name": "branch_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_branches",
              "column": "branch_name",
              "type": "text",
              "value": "{{$_POST.branch_name}}"
            },
            {
              "table": "servo_branches",
              "column": "branch_date_registered",
              "type": "datetime",
              "value": "{{$_POST.branch_date_registered}}"
            }
          ],
          "table": "servo_branches",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "branch_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.branch_id}}",
                "data": {
                  "column": "branch_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_branches\nSET branch_name = :P1 /* {{$_POST.branch_name}} */, branch_date_registered = :P2 /* {{$_POST.branch_date_registered}} */\nWHERE branch_id = :P3 /* {{$_POST.branch_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.branch_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.branch_date_registered}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.branch_id}}"
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