<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "file",
        "name": "file",
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
        "type": "number",
        "name": "file_customer_id"
      },
      {
        "type": "number",
        "name": "file_asset_id"
      },
      {
        "type": "number",
        "name": "file_order_id"
      },
      {
        "type": "number",
        "name": "file_transaction_id"
      },
      {
        "type": "number",
        "name": "file_user_created"
      },
      {
        "type": "datetime",
        "name": "file_date_created"
      },
      {
        "type": "text",
        "name": "file_description"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload_file",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/files",
          "fields": "{{$_POST.file}}"
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
        "name": "insert_file",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_files",
                "column": "file_customer_id",
                "type": "number",
                "value": "{{$_POST.file_customer_id.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_asset_id",
                "type": "number",
                "value": "{{$_POST.file_asset_id.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_order_id",
                "type": "number",
                "value": "{{$_POST.file_order_id.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_transaction_id",
                "type": "number",
                "value": "{{$_POST.file_transaction_id.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_name",
                "type": "text",
                "value": "{{upload_file.name}}"
              },
              {
                "table": "servo_files",
                "column": "file_user_created",
                "type": "number",
                "value": "{{$_POST.file_user_created.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_date_created",
                "type": "datetime",
                "value": "{{$_POST.file_date_created.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_description",
                "type": "text",
                "value": "{{$_POST.file_description.default(null)}}"
              }
            ],
            "table": "servo_files",
            "returning": "file_id",
            "query": "INSERT INTO servo_files\n(file_customer_id, file_asset_id, file_order_id, file_transaction_id, file_name, file_user_created, file_date_created, file_description) VALUES (:P1 /* {{$_POST.file_customer_id.default(null)}} */, :P2 /* {{$_POST.file_asset_id.default(null)}} */, :P3 /* {{$_POST.file_order_id.default(null)}} */, :P4 /* {{$_POST.file_transaction_id.default(null)}} */, :P5 /* {{upload_file.name}} */, :P6 /* {{$_POST.file_user_created.default(null)}} */, :P7 /* {{$_POST.file_date_created.default(null)}} */, :P8 /* {{$_POST.file_description.default(null)}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.file_customer_id.default(null)}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.file_asset_id.default(null)}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.file_order_id.default(null)}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.file_transaction_id.default(null)}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{upload_file.name}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.file_user_created.default(null)}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.file_date_created.default(null)}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.file_description.default(null)}}"
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
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>