<?php
$exports = <<<'JSON'
{
  "name": "servo_logout",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "RYMshymBXz4fk5e",
    "provider": "Database",
    "connection": "servodb",
    "users": {
      "table": "servo_user",
      "identity": "user_id",
      "username": "user_username",
      "password": "password"
    },
    "permissions": {}
  },
  "meta": [
    {
      "name": "identity",
      "type": "text"
    }
  ]
}
JSON;
?>