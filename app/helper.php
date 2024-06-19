<?php

use App\Models\OrderTables;

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

if (!function_exists('generateTableNo')) {
  function generateTableNo()
  {
    $tableCount = OrderTables::count();
    return 'TABLE-' . str_pad($tableCount + 1, 6, '0', STR_PAD_LEFT);
  }
}
