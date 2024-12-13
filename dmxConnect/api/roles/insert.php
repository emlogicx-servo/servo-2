<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/roles.php",
      "linkedForm": "role_create_form"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "role_name",
        "name": "role_name"
      },
      {
        "type": "array",
        "fieldName": "checkbox2",
        "name": "checkbox2"
      },
      {
        "type": "array",
        "name": "record",
        "sub": [
          {
            "type": "number",
            "name": "insert"
          },
          {
            "type": "number",
            "name": "$value"
          },
          {
            "type": "number",
            "name": "role_insert"
          }
        ]
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "role_insert",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_roles",
                "column": "name",
                "type": "text",
                "value": "{{$_POST.role_name}}",
                "recid": 1
              }
            ],
            "table": "servo_roles",
            "returning": "id",
            "query": "insert into `servo_roles` (`name`) values (?)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.role_name}}",
                "test": ""
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ]
      },
      {
        "name": "list",
        "module": "arraylist",
        "action": "create",
        "options": {
          "value": "\n",
          "schema": []
        },
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{$_POST}}",
          "outputFields": [],
          "exec": {
            "steps": [
              {
                "name": "",
                "module": "core",
                "action": "condition",
                "options": {
                  "if": "{{$name!='role_name'}}",
                  "then": {
                    "steps": {
                      "name": "",
                      "module": "arraylist",
                      "action": "add",
                      "options": {
                        "ref": "list",
                        "value": "{{$value}}"
                      }
                    }
                  }
                },
                "outputType": "boolean"
              },
              {
                "name": "",
                "module": "core",
                "action": "response",
                "options": {
                  "status": 200,
                  "data": "{{$_POST}}"
                },
                "disabled": true
              }
            ]
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
        "name": "permission_id",
        "module": "arraylist",
        "action": "value",
        "options": {
          "ref": "list"
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "repeat1",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{permission_id}}",
          "outputFields": [],
          "exec": {
            "steps": {
              "name": "permission_role_insert",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "db",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "servo_permissions_role",
                      "column": "role_id",
                      "type": "number",
                      "value": "{{role_insert.identity}}"
                    },
                    {
                      "table": "servo_permissions_role",
                      "column": "permission_id",
                      "type": "number",
                      "value": "{{$value}}"
                    }
                  ],
                  "table": "servo_permissions_role",
                  "returning": "id",
                  "query": "insert into `servo_permissions_role` (`permission_id`, `role_id`) values (?, ?)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{role_insert.identity}}",
                      "test": ""
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$value}}",
                      "test": ""
                    }
                  ]
                }
              },
              "meta": [
                {
                  "name": "identity",
                  "type": "text"
                },
                {
                  "name": "affected",
                  "type": "number"
                }
              ]
            }
          }
        },
        "output": true,
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
      }
    ]
  }
}
JSON
);
?>