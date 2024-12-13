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
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "role_query",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "db",
          "sql": {
            "type": "select",
            "columns": [
              {
                "table": "servo_roles",
                "column": "id"
              },
              {
                "table": "servo_roles",
                "column": "name"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.role_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_roles"
            },
            "primary": "id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_roles.id",
                  "field": "servo_roles.id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.role_id}}",
                  "data": {
                    "table": "servo_roles",
                    "column": "id",
                    "type": "number",
                    "columnObj": {
                      "type": "increments",
                      "primary": true,
                      "nullable": false,
                      "name": "id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select `id`, `name` from `servo_roles` where `servo_roles`.`id` = ?"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "id"
          },
          {
            "type": "text",
            "name": "name"
          }
        ],
        "type": "dbconnector_single",
        "outputType": "object"
      },
      {
        "name": "role_permission_query",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "db",
          "sql": {
            "query": "select servo_permissions.id, servo_permissions.name from servo_permissions\n\nINNER JOIN servo_permissions_role ON servo_permissions.id = servo_permissions_role.permission_id\n\nwhere servo_permissions_role.role_id = ?",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.role_id}}",
                "test": "15",
                "recid": 1
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "number"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "type": "dbcustom_query"
      },
      {
        "name": "role_permission_query_copy",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "db",
          "sql": {
            "query": "select servo_permissions.id, servo_permissions.name from servo_permissions\nwhere servo_permissions.id  NOT IN (select servo_permissions.id from servo_permissions\n\nINNER JOIN servo_permissions_role ON servo_permissions.id = servo_permissions_role.permission_id\n\nwhere servo_permissions_role.role_id = ?)\n\n",
            "params": [
              {
                "name": ":p1",
                "value": "{{$_GET.role_id}}",
                "test": "15"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "number"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "type": "dbcustom_query"
      }
    ]
  }
}
JSON
);
?>