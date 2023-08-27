<?php
$exports = <<<'JSON'
{
  "name": "logout",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "kppYFYksiVs9YDq",
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