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
          "value": "role:create"
        },
        "meta": [],
        "outputType": "text"
      },
      {
        "name": "list",
        "module": "arraylist",
        "action": "create",
        "options": {},
        "meta": [],
        "outputType": "array"
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
        "outputType": "array"
      },
      {
        "name": "u",
        "module": "arraylist",
        "action": "value",
        "options": {
          "ref": "list"
        },
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{u[0]!=1}}",
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