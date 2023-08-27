<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "project_user_created"
      },
      {
        "type": "text",
        "name": "project_status"
      },
      {
        "type": "text",
        "name": "project_description"
      },
      {
        "type": "datetime",
        "name": "project_date_created"
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
        "type": "text",
        "name": "project_type"
      },
      {
        "type": "text",
        "name": "project_notes"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "create_gugr_project",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_projects",
                "column": "project_code",
                "type": "text",
                "value": "{{$_POST.project_code}}"
              },
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
                "column": "project_status",
                "type": "text",
                "value": "{{$_POST.project_status}}"
              },
              {
                "table": "servo_projects",
                "column": "project_user_created",
                "type": "number",
                "value": "{{$_POST.project_user_created}}"
              },
              {
                "table": "servo_projects",
                "column": "project_date_created",
                "type": "datetime",
                "value": "{{$_POST.project_date_created}}"
              },
              {
                "table": "servo_projects",
                "column": "project_type",
                "type": "text",
                "value": "{{$_POST.project_type}}"
              },
              {
                "table": "servo_projects",
                "column": "project_notes",
                "type": "text",
                "value": "{{$_POST.project_notes}}"
              }
            ],
            "table": "servo_projects",
            "returning": "project_id",
            "query": "INSERT INTO servo_projects\n(project_code, project_description, project_date_due, project_status, project_user_created, project_date_created, project_type, project_notes) VALUES (:P1 /* {{$_POST.project_code}} */, :P2 /* {{$_POST.project_description}} */, :P3 /* {{$_POST.project_date_due}} */, :P4 /* {{$_POST.project_status}} */, :P5 /* {{$_POST.project_user_created}} */, :P6 /* {{$_POST.project_date_created}} */, :P7 /* {{$_POST.project_type}} */, :P8 /* {{$_POST.project_notes}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.project_code}}",
                "test": ""
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.project_description}}",
                "test": ""
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.project_date_due}}",
                "test": ""
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.project_status}}",
                "test": ""
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.project_user_created}}",
                "test": ""
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.project_date_created}}",
                "test": ""
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.project_type}}",
                "test": ""
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.project_notes}}",
                "test": ""
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
        ],
        "output": true
      },
      {
        "name": "last_project_insert",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "number"
          }
        ]
      },
      {
        "name": "current_project",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{last_project_insert['last_insert_id()']}}"
        },
        "meta": [],
        "outputType": "number",
        "output": true
      }
    ]
  }
}
JSON
);
?>