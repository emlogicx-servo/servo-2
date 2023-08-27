<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "data_field_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_data_field",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_data_fields",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "data_field_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.data_field_id}}",
                "data": {
                  "column": "data_field_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "data_field_id",
          "query": "DELETE\nFROM servo_data_fields\nWHERE data_field_id = :P1 /* {{$_POST.data_field_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.data_field_id}}"
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