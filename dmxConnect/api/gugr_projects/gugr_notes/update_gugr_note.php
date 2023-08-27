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
        "name": "project_note_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_project_note",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_project_notes",
              "column": "project_note",
              "type": "text",
              "value": "{{$_POST.project_note}}"
            }
          ],
          "table": "servo_project_notes",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "project_note_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.project_note_id}}",
                "data": {
                  "column": "project_note_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "project_note_id",
          "query": "UPDATE servo_project_notes\nSET project_note = :P1 /* {{$_POST.project_note}} */\nWHERE project_note_id = :P2 /* {{$_POST.project_note_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.project_note}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.project_note_id}}",
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