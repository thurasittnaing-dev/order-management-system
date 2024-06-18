<?php


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
