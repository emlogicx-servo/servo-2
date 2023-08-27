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
        "name": "project_description"
      },
      {
        "type": "datetime",
        "name": "project_date_due"
      },
      {
        "type": "text",
        "name": "project_code"
      },
      {
        "type": "number",
        "name": "project_id"
      },
      {
        "type": "text",
        "name": "project_notes"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_gugr_project_reception",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_projects",
              "column": "project_description",
              "type": "text",
              "value": "{{$_POST.project_description}}"
            },
            {
              "table": "servo_projects",
              "column": "project_date_due",
              "type": "datetime",
              "value": "{{$_POST.project_date_due}}"
            },
            {
              "table": "servo_projects",
              "column": "project_code",
              "type": "text",
              "value": "{{$_POST.project_code}}"
            },
            {
              "table": "servo_projects",
              "column": "project_notes",
              "type": "text",
              "value": "{{$_POST.project_notes}}"
            }
          ],
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
          "query": "UPDATE servo_projects\nSET project_description = :P1 /* {{$_POST.project_description}} */, project_date_due = :P2 /* {{$_POST.project_date_due}} */, project_code = :P3 /* {{$_POST.project_code}} */, project_notes = :P4 /* {{$_POST.project_notes}} */\nWHERE project_id = :P5 /* {{$_POST.project_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.project_description}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.project_date_due}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.project_code}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.project_notes}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>