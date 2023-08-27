<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "shift_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "custom_list_users_sorted_for_shift",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "select user_id, user_fname, user_lname, user_username, servo_user_departments_department_id, user_profile, department_id, department_name from servo_user inner join servo_department on department_id = servo_user_departments_department_id \nwhere user_id NOT IN\n(select servo_user_user_id from servo_user_shifts where servo_shifts_shift_id = :P1);\n",
          "params": [
            {
              "name": ":P1",
              "value": "{{$_GET.shift_id}}"
            }
          ]
        }
      },
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
        },
        {
          "name": "user_username",
          "type": "text"
        },
        {
          "name": "servo_user_departments_department_id",
          "type": "number"
        },
        {
          "name": "user_profile",
          "type": "text"
        },
        {
          "name": "department_id",
          "type": "number"
        },
        {
          "name": "department_name",
          "type": "text"
        }
      ],
      "outputType": "array",
      "output": true
    }
  }
}
JSON
);
?>