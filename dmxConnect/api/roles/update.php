<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/roles.php",
      "linkedForm": "role_update_form"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "role_name",
        "name": "role_name"
      },
      {
        "type": "text",
        "fieldName": "role_id",
        "name": "role_id"
      },
      {
        "type": "text",
        "fieldName": "name",
        "multiple": true,
        "name": "name"
      },
      {
        "type": "array",
        "name": "record",
        "sub": [
          {
            "type": "number",
            "name": "$_POST"
          },
          {
            "type": "number",
            "name": "$value"
          }
        ]
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "update",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "db",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "servo_roles",
                "column": "name",
                "type": "text",
                "value": "{{$_POST.role_name}}"
              }
            ],
            "table": "servo_roles",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "id",
                  "field": "id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.role_id}}",
                  "data": {
                    "column": "id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "id",
            "query": "update `servo_roles` set `name` = ? where `id` = ?",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.role_name}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.role_id}}",
                "test": ""
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ]
      },
      {
        "name": "delete_prev_info",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "db",
          "sql": {
            "query": "DELETE from servo_permissions_role where servo_permissions_role.role_id = ?",
            "params": [
              {
                "name": "?",
                "value": "{{$_POST.role_id}}"
              }
            ]
          }
        },
        "meta": [],
        "outputType": "array"
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
            "steps": {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{$name!='role_name'&&$name!='role_id'}}",
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
                      "value": "{{$_POST.role_id}}",
                      "recid": 1
                    },
                    {
                      "table": "servo_permissions_role",
                      "column": "permission_id",
                      "type": "number",
                      "value": "{{$value}}",
                      "recid": 2
                    }
                  ],
                  "table": "servo_permissions_role",
                  "returning": "id",
                  "query": "insert into `servo_permissions_role` (`permission_id`, `role_id`) values (?, ?)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.role_id}}",
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