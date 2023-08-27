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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_create_branch",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
          "returning": "branch_id",
          "query": "INSERT INTO servo_branches\n(branch_name, branch_date_registered) VALUES (:P1 /* {{$_POST.branch_name}} */, :P2 /* {{$_POST.branch_date_registered}} */)",
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