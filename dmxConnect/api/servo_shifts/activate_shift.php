<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "custom_activate_shift_deactivate_shifts",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "update servo_shifts\nset shift_status = 'Closed'\nwhere shift_status = 'Active';",
            "params": []
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "custom_activate_shift_activate_shift",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "update servo_shifts\nset shift_status = 'Active'\nwhere shift_id = :P1;",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_POST.shift_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>