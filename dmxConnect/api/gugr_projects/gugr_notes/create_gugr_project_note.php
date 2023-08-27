<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "project_note"
      },
      {
        "type": "number",
        "name": "project_note_user_created"
      },
      {
        "type": "number",
        "name": "project_note_project_id"
      },
      {
        "type": "datetime",
        "name": "date_created"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert_project_note",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_project_notes",
              "column": "project_note",
              "type": "text",
              "value": "{{$_POST.project_note}}"
            },
            {
              "table": "servo_project_notes",
              "column": "project_note_user_created",
              "type": "number",
              "value": "{{$_POST.project_note_user_created}}"
            },
            {
              "table": "servo_project_notes",
              "column": "date_created",
              "type": "datetime",
              "value": "{{$_POST.date_created}}"
            },
            {
              "table": "servo_project_notes",
              "column": "project_note_project_id",
              "type": "number",
              "value": "{{$_POST.project_note_project_id}}"
            }
          ],
          "table": "servo_project_notes",
          "returning": "project_note_id",
          "query": "INSERT INTO servo_project_notes\n(project_note, project_note_user_created, date_created, project_note_project_id) VALUES (:P1 /* {{$_POST.project_note}} */, :P2 /* {{$_POST.project_note_user_created}} */, :P3 /* {{$_POST.date_created}} */, :P4 /* {{$_POST.project_note_project_id}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.project_note}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.project_note_user_created}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.date_created}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.project_note_project_id}}",
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
      ]
    }
  }
}
JSON
);
?>