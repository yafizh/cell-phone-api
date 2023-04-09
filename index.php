<?php
require_once('database/connection.php');
$route = explode('/', $_SERVER['REQUEST_URI'])[2] ?? null;
$param = explode('/', $_SERVER['REQUEST_URI'])[3] ?? null;
$request_method = $_SERVER["REQUEST_METHOD"];

switch (strtoupper($route)) {
    case 'USERS':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/users/index.php');
                else
                    include_once('./api/users/show.php');
                break;
            case 'POST':
                include_once('./api/users/store.php');
                break;
            case 'PUT':
                include_once('./api/users/update.php');
                break;
            case 'DELETE':
                include_once('./api/users/delete.php');
                break;
        }
        break;
    case 'EMPLOYEES':
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
}
