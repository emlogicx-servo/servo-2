<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "file",
        "name": "company_logo_file",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "text",
        "name": "company_logo"
      },
      {
        "type": "number",
        "name": "company_info_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "fileRemove",
        "module": "fs",
        "action": "remove",
        "options": {
          "path": "{{'/uploads/'+$_POST.company_logo}}"
        },
        "outputType": "boolean",
        "disabled": true
      },
      {
        "name": "upload",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads",
          "fields": "{{$_POST.company_logo_file}}",
          "overwrite": true
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file"
      },
      {
        "name": "update",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "servo_company_info",
                "column": "company_logo",
                "type": "text",
                "value": "{{upload.name}}"
              },
              {
                "table": "servo_company_info",
                "column": "company_info_id",
                "type": "number",
                "value": "{{$_POST.company_info_id}}"
              }
            ],
            "table": "servo_company_info",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "company_info_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.company_info_id}}",
                  "data": {
                    "column": "company_info_id"
                  },
                  "operation": "="
                }
              ]
            },
            "query": "UPDATE servo_company_info\nSET company_logo = :P1 /* {{upload.name}} */, company_info_id = :P2 /* {{$_POST.company_info_id}} */\nWHERE company_info_id = :P3 /* {{$_POST.company_info_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{upload.name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.company_info_id}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_POST.company_info_id}}"
              }
            ],
            "returning": "company_info_id"
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>