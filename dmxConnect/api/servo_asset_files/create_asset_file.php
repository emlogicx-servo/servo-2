<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "asset_file"
      },
      {
        "type": "text",
        "name": "asset_file_type"
      },
      {
        "type": "number",
        "name": "asset_file_creator"
      },
      {
        "type": "datetime",
        "name": "asset_file_date_created"
      },
      {
        "type": "file",
        "name": "assetFile",
        "sub": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "number"
          },
          {
            "name": "error",
            "type": "text"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "number",
        "name": "asset_file_asset_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload_asset_file",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/asset_files/",
          "fields": "{{$_POST.assetFile}}"
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
        "name": "insert_asset_file",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_asset_files",
                "column": "asset_file",
                "type": "text",
                "value": "{{upload_asset_file.name}}"
              },
              {
                "table": "servo_asset_files",
                "column": "asset_file_type",
                "type": "text",
                "value": "{{$_POST.asset_file_type}}"
              },
              {
                "table": "servo_asset_files",
                "column": "asset_file_creator",
                "type": "number",
                "value": "{{$_POST.asset_file_creator}}"
              },
              {
                "table": "servo_asset_files",
                "column": "asset_file_date_created",
                "type": "datetime",
                "value": "{{$_POST.asset_file_date_created}}"
              },
              {
                "table": "servo_asset_files",
                "column": "asset_file_asset_id",
                "type": "number",
                "value": "{{$_POST.asset_file_asset_id}}"
              }
            ],
            "table": "servo_asset_files",
            "returning": "asset_file_id",
            "query": "INSERT INTO servo_asset_files\n(asset_file, asset_file_type, asset_file_creator, asset_file_date_created, asset_file_asset_id) VALUES (:P1 /* {{upload_asset_file.name}} */, :P2 /* {{$_POST.asset_file_type}} */, :P3 /* {{$_POST.asset_file_creator}} */, :P4 /* {{$_POST.asset_file_date_created}} */, :P5 /* {{$_POST.asset_file_asset_id}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{upload_asset_file.name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.asset_file_type}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.asset_file_creator}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.asset_file_date_created}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.asset_file_asset_id}}"
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