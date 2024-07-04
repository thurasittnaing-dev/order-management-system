<?php

use App\Models\OrderTables;
use App\Models\Order;

if (!function_exists('menu_active')) {
  function menu_active($module)
  {
    $checkLists = array(
      $module => [
        $module . '.index',
        $module . '.create',
        $module . '.edit',
        $module . '.show',
      ]
    );
    $modules =  $checkLists[$module];
    $routeName = Route::currentRouteName();
    return in_array($routeName, $modules) ? 'active' : '';
  }
}


if (!function_exists('singleMenuActive')) {
  function singleMenuActive($routeName)
  {
    return Route::currentRouteName() == $routeName ? 'active' : '';
  }
}




if (!function_exists('getTableIndexer')) {
  function getTableIndexer($pagination_number)
  {
    return (request('page', 1) - 1) * $pagination_number;
  }
}

if (!function_exists('generateTableNo')) {
  function generateTableNo()
  {
    $tableCount = OrderTables::count();
    return 'TABLE-' . str_pad($tableCount + 1, 6, '0', STR_PAD_LEFT);
  }
}

if (!function_exists('generateInvoiceNo')) {
  function generateInvoiceNo()
  {
    $orderCount = Order::count();
    return 'INV-' . str_pad($orderCount + 1, 6, '0', STR_PAD_LEFT);
  }
}
