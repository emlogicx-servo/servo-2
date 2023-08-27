<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "data_reading_session_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_data_reading_session",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_data_reading_session",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "data_reading_session_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.data_reading_session_id}}",
                "data": {
                  "column": "data_reading_session_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "data_reading_session_id",
          "query": "DELETE\nFROM servo_data_reading_session\nWHERE data_reading_session_id = :P1 /* {{$_POST.data_reading_session_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.data_reading_session_id}}"
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