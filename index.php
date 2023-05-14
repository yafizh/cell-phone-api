<?php
require_once('database/connection.php');
$route = explode('/', $_SERVER['REQUEST_URI'])[2] ?? null;
$param = explode('/', $_SERVER['REQUEST_URI'])[3] ?? null;
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($route) {
    case 'admin':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/admin/index.php');
                else
                    include_once('./api/admin/show.php');
                break;
            case 'POST':
                include_once('./api/admin/store.php');
                break;
            case 'PUT':
                include_once('./api/admin/update.php');
                break;
            case 'DELETE':
                include_once('./api/admin/delete.php');
                break;
        }
        break;
    case 'employees':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/employees/index.php');
                else
                    include_once('./api/employees/show.php');
                break;
            case 'POST':
                include_once('./api/employees/store.php');
                break;
            case 'PUT':
                include_once('./api/employees/update.php');
                break;
            case 'DELETE':
                include_once('./api/employees/delete.php');
                break;
        }
        break;
    case 'item-types':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/item_types/index.php');
                else
                    include_once('./api/item_types/show.php');
                break;
            case 'POST':
                include_once('./api/item_types/store.php');
                break;
            case 'PUT':
                include_once('./api/item_types/update.php');
                break;
            case 'DELETE':
                include_once('./api/item_types/delete.php');
                break;
        }
        break;
}
