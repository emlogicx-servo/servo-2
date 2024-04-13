<?php
$exports = <<<'JSON'
{
  "name": "servo_login",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "servo_login_key",
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
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "=",
            "value": "Admin"
          }
        ]
      },
      "Cashier": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "=",
            "value": "Cashier"
          }
        ]
      },
      "Waiter": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "=",
            "value": "Waiter"
          }
        ]
      },
      "Service": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "=",
            "value": "Service"
          }
        ]
      },
      "Manager": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "in",
            "value": [
              "Manager",
              "Admin"
            ]
          }
        ]
      },
      "Support": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "=",
            "value": "Support"
          }
        ]
      },
      "cc-admin": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": []
      },
      "cc-gu": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": []
      },
      "cc-pm": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": []
      },
      "cc-rm": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": []
      },
      "gugr-admin": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": []
      },
      "smanager": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "=",
            "value": "smanager"
          }
        ]
      },
      "dmanager": {
        "table": "servo_user",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_profile",
            "operator": "in",
            "value": [
              "dmanager",
              "Admin"
            ]
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