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
        "type": "number",
        "name": "user_created"
      },
      {
        "type": "number",
        "name": "user_concerned"
      },
      {
        "type": "text",
        "name": "project_notes"
      },
      {
        "type": "text",
        "name": "project_status"
      },
      {
        "type": "number",
        "name": "project_customer"
      },
      {
        "type": "number",
        "name": "project_asset"
      },
      {
        "type": "text",
        "name": "project_description"
      },
      {
        "type": "text",
        "name": "project_type"
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
        "type": "number",
        "name": "project_id"
      },
      {
        "type": "number",
        "name": "project_user_created"
      },
      {
        "type": "number",
        "name": "project_user_concerned"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_gugr_project",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_projects",
              "column": "project_notes",
              "type": "text",
              "value": "{{$_POST.project_notes}}"
            },
            {
              "table": "servo_projects",
              "column": "project_status",
              "type": "text",
              "value": "{{$_POST.project_status}}"
            },
            {
              "table": "servo_projects",
              "column": "project_customer",
              "type": "number",
              "value": "{{$_POST.project_customer}}"
            },
            {
              "table": "servo_projects",
              "column": "project_asset",
              "type": "number",
              "value": "{{$_POST.project_asset}}"
            },
            {
              "table": "servo_projects",
              "column": "project_description",
              "type": "text",
              "value": "{{$_POST.project_description}}"
            },
            {
              "table": "servo_projects",
              "column": "project_type",
              "type": "text",
              "value": "{{$_POST.project_type}}"
            },
            {
              "table": "servo_projects",
              "column": "project_date_created",
              "type": "datetime",
              "value": "{{$_POST.project_date_created}}"
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
              "column": "project_user_created",
              "type": "number",
              "value": "{{$_POST.project_user_created}}"
            },
            {
              "table": "servo_projects",
              "column": "project_user_concerned",
              "type": "number",
              "value": "{{$_POST.project_user_concerned}}"
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
          "query": "UPDATE servo_projects\nSET project_notes = :P1 /* {{$_POST.project_notes}} */, project_status = :P2 /* {{$_POST.project_status}} */, project_customer = :P3 /* {{$_POST.project_customer}} */, project_asset = :P4 /* {{$_POST.project_asset}} */, project_description = :P5 /* {{$_POST.project_description}} */, project_type = :P6 /* {{$_POST.project_type}} */, project_date_created = :P7 /* {{$_POST.project_date_created}} */, project_date_due = :P8 /* {{$_POST.project_date_due}} */, project_code = :P9 /* {{$_POST.project_code}} */, project_user_created = :P10 /* {{$_POST.project_user_created}} */, project_user_concerned = :P11 /* {{$_POST.project_user_concerned}} */\nWHERE project_id = :P12 /* {{$_POST.project_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.project_notes}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.project_status}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.project_customer}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.project_asset}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.project_description}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.project_type}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.project_date_created}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.project_date_due}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.project_code}}",
              "test": ""
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.project_user_created}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.project_user_concerned}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P12",
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