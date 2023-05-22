<?php
require_once('database/connection.php');
date_default_timezone_set('Asia/Kuala_Lumpur');
$route = explode('/', $_SERVER['PHP_SELF'])[3] ?? null;
$param = explode('/', $_SERVER['PHP_SELF'])[4] ?? null;
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
    case 'items':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/items/index.php');
                else
                    include_once('./api/items/show.php');
                break;
            case 'POST':
                include_once('./api/items/store.php');
                break;
            case 'PUT':
                include_once('./api/items/update.php');
                break;
            case 'DELETE':
                include_once('./api/items/delete.php');
                break;
        }
        break;
    case 'item-in':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/item_in/index.php');
                else
                    include_once('./api/item_in/show.php');
                break;
            case 'POST':
                include_once('./api/item_in/store.php');
                break;
            case 'PUT':
                include_once('./api/item_in/update.php');
                break;
            case 'DELETE':
                include_once('./api/item_in/delete.php');
                break;
        }
        break;
    case 'item-out':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/item_out/index.php');
                else
                    include_once('./api/item_out/show.php');
                break;
            case 'POST':
                include_once('./api/item_out/store.php');
                break;
            case 'PUT':
                include_once('./api/item_out/update.php');
                break;
            case 'DELETE':
                include_once('./api/item_out/delete.php');
                break;
        }
        break;
    case 'balances':
        switch ($request_method) {
            case 'GET':
                include_once('./api/balances/index.php');
                break;
        }
        break;
    case 'balance-in':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/balance_in/index.php');
                break;
            case 'POST':
                include_once('./api/balance_in/store.php');
                break;
            case 'PUT':
                include_once('./api/balance_in/update.php');
                break;
            case 'DELETE':
                include_once('./api/balance_in/delete.php');
                break;
        }
        break;
    case 'credits':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/credits/index.php');
                else
                    include_once('./api/credits/show.php');
                break;
            case 'POST':
                include_once('./api/credits/store.php');
                break;
            case 'PUT':
                include_once('./api/credits/update.php');
                break;
            case 'DELETE':
                include_once('./api/credits/delete.php');
                break;
        }
        break;
    case 'credit-prices':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/credit_prices/index.php');
                else
                    include_once('./api/credit_prices/show.php');
                break;
            case 'POST':
                include_once('./api/credit_prices/store.php');
                break;
            case 'PUT':
                include_once('./api/credit_prices/update.php');
                break;
            case 'DELETE':
                include_once('./api/credit_prices/delete.php');
                break;
        }
        break;
    case 'credit-out':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/credit_out/index.php');
                else
                    include_once('./api/credit_out/show.php');
                break;
            case 'POST':
                include_once('./api/credit_out/store.php');
                break;
            case 'PUT':
                include_once('./api/credit_out/update.php');
                break;
            case 'DELETE':
                include_once('./api/credit_out/delete.php');
                break;
        }
        break;
    case 'topups':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/topups/index.php');
                else
                    include_once('./api/topups/show.php');
                break;
            case 'POST':
                include_once('./api/topups/store.php');
                break;
            case 'PUT':
                include_once('./api/topups/update.php');
                break;
            case 'DELETE':
                include_once('./api/topups/delete.php');
                break;
        }
        break;
    case 'topup-prices':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/topup_prices/index.php');
                else
                    include_once('./api/topup_prices/show.php');
                break;
            case 'POST':
                include_once('./api/topup_prices/store.php');
                break;
            case 'PUT':
                include_once('./api/topup_prices/update.php');
                break;
            case 'DELETE':
                include_once('./api/topup_prices/delete.php');
                break;
        }
        break;
    case 'topup-out':
        switch ($request_method) {
            case 'GET':
                if (is_null($param))
                    include_once('./api/topup_out/index.php');
                break;
            case 'POST':
                include_once('./api/topup_out/store.php');
                break;
            case 'PUT':
                include_once('./api/topup_out/update.php');
                break;
            case 'DELETE':
                include_once('./api/topup_out/delete.php');
                break;
        }
        break;
}
