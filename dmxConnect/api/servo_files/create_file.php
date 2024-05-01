<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
        "type": "text",
        "name": "file_name"
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
      },
      {
        "type": "number",
        "name": "file_po_id"
      },
      {
        "type": "number",
        "name": "file_project_id"
      },
      {
        "type": "number",
        "name": "file_project_task_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "uploadFile",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/files",
          "fields": "{{$_POST.file_name}}"
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
        "outputType": "array"
      },
      {
        "name": "create_file",
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
                "value": "{{uploadFile.name}}"
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
              },
              {
                "table": "servo_files",
                "column": "file_po_id",
                "type": "number",
                "value": "{{$_POST.file_po_id.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_project_id",
                "type": "number",
                "value": "{{$_POST.file_project_id.default(null)}}"
              },
              {
                "table": "servo_files",
                "column": "file_project_task_id",
                "type": "number",
                "value": "{{$_POST.file_project_task_id.default(null)}}"
              }
            ],
            "table": "servo_files",
            "returning": "file_id",
            "query": "insert into `servo_files` (`file_asset_id`, `file_customer_id`, `file_date_created`, `file_description`, `file_name`, `file_order_id`, `file_po_id`, `file_project_id`, `file_project_task_id`, `file_transaction_id`, `file_user_created`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.file_customer_id.default(null)}}",
                "test": ""
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.file_asset_id.default(null)}}",
                "test": ""
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.file_order_id.default(null)}}",
                "test": ""
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.file_transaction_id.default(null)}}",
                "test": ""
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{uploadFile.name}}",
                "test": ""
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.file_user_created.default(null)}}",
                "test": ""
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.file_date_created.default(null)}}",
                "test": ""
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.file_description.default(null)}}",
                "test": ""
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.file_po_id.default(null)}}",
                "test": ""
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.file_project_id.default(null)}}",
                "test": ""
              },
              {
                "name": ":P11",
                "type": "expression",
                "value": "{{$_POST.file_project_task_id.default(null)}}",
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
    ]
  }
}
JSON
);
?>