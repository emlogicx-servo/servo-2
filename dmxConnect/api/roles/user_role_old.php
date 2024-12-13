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
    "steps": {
      "name": "user_has_role",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "db",
        "sql": {
          "query": "SELECT servo_user.user_id,servo_user.user_fname, servo_user.user_lname from servo_user inner join servo_role_user on servo_role_user.user_id = servo_user.user_id\n\nwhere servo_role_user.role_id = ?",
          "params": [
            {
              "name": "?",
              "value": "{{$_GET.role_id}}",
              "test": "8"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "user_id",
          "type": "number"
        },
        {
          "name": "user_fname",
          "type": "text"
        },
        {
          "name": "user_lname",
          "type": "text"
        }
      ]
    }
  }
}
JSON
);
?>