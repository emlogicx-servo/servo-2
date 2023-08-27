<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "project_file_description"
      },
      {
        "type": "number",
        "name": "project_file_creator"
      },
      {
        "type": "datetime",
        "name": "project_file_date_created"
      },
      {
        "type": "number",
        "name": "project_file_project_id"
      },
      {
        "type": "text",
        "name": "project_file"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload_project_file",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/project_files/",
          "fields": "{{$_POST.project_file}}"
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
        "name": "insert_project_file",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_project_files",
                "column": "project_file",
                "type": "text",
                "value": "{{upload_project_file.name}}"
              },
              {
                "table": "servo_project_files",
                "column": "project_file_description",
                "type": "text",
                "value": "{{$_POST.project_file_description}}"
              },
              {
                "table": "servo_project_files",
                "column": "project_file_creator",
                "type": "number",
                "value": "{{$_POST.project_file_creator}}"
              },
              {
                "table": "servo_project_files",
                "column": "project_file_date_created",
                "type": "datetime",
                "value": "{{$_POST.project_file_date_created}}"
              },
              {
                "table": "servo_project_files",
                "column": "project_file_project_id",
                "type": "number",
                "value": "{{$_POST.project_file_project_id}}"
              }
            ],
            "table": "servo_project_files",
            "returning": "project_file_id",
            "query": "INSERT INTO servo_project_files\n(project_file, project_file_description, project_file_creator, project_file_date_created, project_file_project_id) VALUES (:P1 /* {{upload_project_file.name}} */, :P2 /* {{$_POST.project_file_description}} */, :P3 /* {{$_POST.project_file_creator}} */, :P4 /* {{$_POST.project_file_date_created}} */, :P5 /* {{$_POST.project_file_project_id}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{upload_project_file.name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.project_file_description}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.project_file_creator}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.project_file_date_created}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.project_file_project_id}}"
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
    ]
  }
}
JSON
);
?>