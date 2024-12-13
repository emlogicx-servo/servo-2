<?php
$exports = <<<'JSON'
{
  "meta": {
    "$_SESSION": [
      {
        "type": "text",
        "name": "user_permissions"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "permission",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "role:read"
        },
        "meta": [],
        "outputType": "text"
      },
      {
        "name": "identity",
        "module": "auth",
        "action": "identify",
        "options": {
          "provider": "servo_login"
        },
        "meta": []
      },
      {
        "name": "user_permission",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT servo_permissions.name\nFROM servo_permissions\nINNER JOIN servo_permissions_role\nON servo_permissions.id = servo_permissions_role.permission_id\nWHERE servo_permissions_role.role_id \nIN (SELECT servo_role_user.role_id\n        FROM servo_role_user\n        WHERE servo_role_user.user_id = ?\n        GROUP BY servo_role_user.role_id\n        )\nAND\nservo_permissions.name = :permission\nGROUP BY servo_permissions.id",
            "params": [
              {
                "name": "?",
                "value": "{{identity}}",
                "test": "1"
              },
              {
                "name": ":permission",
                "value": "{{permission}}",
                "test": "role:read"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "list",
        "module": "arraylist",
        "action": "create",
        "options": {},
        "meta": [],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{$_SESSION.user_permissions}}",
          "outputFields": [],
          "exec": {
            "steps": {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{$value.name==permission}}",
                "then": {
                  "steps": {
                    "name": "",
                    "module": "arraylist",
                    "action": "add",
                    "options": {
                      "ref": "list",
                      "value": 1
                    }
                  }
                }
              },
              "outputType": "boolean"
            }
          }
        },
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          }
        ],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "u",
        "module": "arraylist",
        "action": "value",
        "options": {
          "ref": "list"
        },
        "meta": [],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{user_permission[0].name!=permission}}",
          "then": {
            "steps": {
              "name": "",
              "module": "core",
              "action": "response",
              "options": {
                "status": 403,
                "data": "{{hasPermmm}}"
              }
            }
          }
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON;
?>