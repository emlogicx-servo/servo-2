<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "data_field_reading_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_data_field_id",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_data_field_readings",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "data_field_reading_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.data_field_reading_id}}",
                "data": {
                  "column": "data_field_reading_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "data_field_reading_id",
          "query": "DELETE\nFROM servo_data_field_readings\nWHERE data_field_reading_id = :P1 /* {{$_POST.data_field_reading_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.data_field_reading_id}}"
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