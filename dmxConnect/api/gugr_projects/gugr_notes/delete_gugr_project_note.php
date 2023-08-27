<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete_project_note",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
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
      "query": "DELETE\nFROM servo_project_notes\nWHERE project_note_id = :P1 /* {{$_POST.project_note_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
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
JSON
);
?>