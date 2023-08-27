<?php
$exports = <<<'JSON'
{
  "name": "servo_login",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "servo_key_123",
    "provider": "Database",
    "connection": "servodb",
    "users": {
      "table": "servo_user",
      "identity": "user_id",
      "username": "user_username",
      "password": "password"
    },
    "permissions": {
      "Admin": {
        "table": "servo_user_profile",
        "identity": "user_profile_name",
        "conditions": [
          {
            "column": "user_profile_name",
            "operator": "=",
            "value": "Admin"
          }
        ]
      },
      "Waiter": {
        "table": "servo_user_profile",
        "identity": "user_profile_name",
        "conditions": [
          {
            "column": "user_profile_name",
            "operator": "=",
            "value": "Waiter"
          }
        ]
      },
      "Cashier": {
        "table": "servo_user_profile",
        "identity": "user_profile_name",
        "conditions": [
          {
            "column": "user_profile_name",
            "operator": "=",
            "value": "Cashier"
          }
        ]
      }
    }
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