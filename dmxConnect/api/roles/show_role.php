<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "role_id"
      }
    ]
  },
  "exec": {
    "steps": [
      "lib/resource",
      {
        "name": "num_row",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT \nCOUNT(servo_user.user_id) as total \nfrom servo_user \ninner join servo_role_user \non servo_role_user.user_id = servo_user.user_id\nwhere servo_role_user.role_id = :P1",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.role_id}}",
                "test": "1"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "total",
            "type": "text"
          }
        ]
      },
      {
        "name": "num_row_copy",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT \nCOUNT(servo_user.user_id) as total \nfrom servo_user \ninner join servo_role_user \non servo_role_user.user_id = servo_user.user_id\nwhere servo_role_user.role_id = :P1",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.role_id}}",
                "test": "1"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "total",
            "type": "text"
          }
        ]
      }
    ]
  }
}
JSON
);
?>