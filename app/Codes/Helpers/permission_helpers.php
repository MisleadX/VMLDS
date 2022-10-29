<?php

if (!function_exists('listAllMenu')) {
    /**
     * @return array[]
     */
    function listAllMenu(): array
    {
        return [
            [
                'name' => __('general.contact'),
                'icon' => '<i class="nav-icon fa fa-address-book-o"></i>',
                'title' => __('general.contact'),
                'active' => ['admin.contact.'],
                'route' => 'admin.contact.index',
                'key' => 'contact',
                'type' => 1,
            ],
            [
                'name' => __('general.setting'),
                'icon' => '<i class="nav-icon fa fa-gear"></i>',
                'title' => __('general.setting'),
                'active' => [
                    'admin.settings.',
                    'admin.admin.',
                    'admin.page.',
                    'admin.role.',
                ],
                'type' => 2,
                'data' => [
                    [
                        'name' => __('general.setting'),
                        'title' => __('general.setting'),
                        'active' => ['admin.settings.'],
                        'route' => 'admin.settings.index',
                        'key' => 'settings',
                        'type' => 1
                    ],
                    [
                        'name' => __('general.admin'),
                        'title' => __('general.admin'),
                        'active' => ['admin.admin.'],
                        'route' => 'admin.admin.index',
                        'key' => 'admin',
                        'type' => 1
                    ],
                    [
                        'name' => __('general.page'),
                        'title' => __('general.page'),
                        'active' => ['admin.page.'],
                        'route' => 'admin.page.index',
                        'key' => 'page',
                        'type' => 1
                    ],
                    [
                        'name' => __('general.role'),
                        'title' => __('general.role'),
                        'active' => ['admin.role.'],
                        'route' => 'admin.role.index',
                        'key' => 'role',
                        'type' => 1
                    ],
                ],
            ]
        ];
    }
}

if (!function_exists('listAvailablePermission')) {
    /**
     * @return array
     */
    function listAvailablePermission(): array
    {

        $listPermission = [];

        //Read & Edit
        foreach ([
                    'page',
                    'settings',
                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.' . $keyPermission . '.index',
                    'admin.' . $keyPermission . '.dataTable'
                ],
                'edit' => [
                    'admin.' . $keyPermission . '.edit',
                    'admin.' . $keyPermission . '.update'
                ],
                'show' => [
                    'admin.' . $keyPermission . '.show'
                ]
            ];
        }

        //Read Only
        foreach ([
                    'contact',
                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.' . $keyPermission . '.index',
                    'admin.' . $keyPermission . '.dataTable'
                ],
                'show' => [
                    'admin.' . $keyPermission . '.show'
                ]
            ];
        }

        //CRUD Full Access
        foreach ([
                    'admin',
                    'role',
                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.' . $keyPermission . '.index',
                    'admin.' . $keyPermission . '.dataTable'
                ],
                'create' => [
                    'admin.' . $keyPermission . '.create',
                    'admin.' . $keyPermission . '.store'
                ],
                'edit' => [
                    'admin.' . $keyPermission . '.edit',
                    'admin.' . $keyPermission . '.update'
                ],
                'show' => [
                    'admin.' . $keyPermission . '.show'
                ],
                'destroy' => [
                    'admin.' . $keyPermission . '.destroy'
                ]
            ];
        }

        //CRU, No Delete
        foreach ([

                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.' . $keyPermission . '.index',
                    'admin.' . $keyPermission . '.dataTable'
                ],
                'create' => [
                    'admin.' . $keyPermission . '.create',
                    'admin.' . $keyPermission . '.store'
                ],
                'edit' => [
                    'admin.' . $keyPermission . '.edit',
                    'admin.' . $keyPermission . '.update'
                ],
                'show' => [
                    'admin.' . $keyPermission . '.show'
                ],
            ];
        }

        //Create & Read Only
        foreach ([

                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.' . $keyPermission . '.index',
                    'admin.' . $keyPermission . '.dataTable'
                ],
                'create' => [
                    'admin.' . $keyPermission . '.create',
                    'admin.' . $keyPermission . '.store'
                ],
                'show' => [
                    'admin.' . $keyPermission . '.show'
                ],
            ];
        }

        $listPermission['admin']['edit'][] = 'admin.admin.password';
        $listPermission['admin']['edit'][] = 'admin.admin.updatePassword';
        $listPermission['contact']['show'][] = 'admin.contact.read';

        return $listPermission;
    }
}

if (!function_exists('generateMenu')) {
    /**
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function generateMenu(): string
    {
        $html = '';
        $adminRole = session()->get('admin_role');
        if ($adminRole) {
            $role = \Illuminate\Support\Facades\Cache::remember('role' . $adminRole, env('SESSION_LIFETIME'), function () use ($adminRole) {
                return \App\Codes\Models\Role::where('id', '=', $adminRole)->first();
            });
            if ($role) {
                $permissionRoute = json_decode($role->permission_route, TRUE);
                $getRoute = \Illuminate\Support\Facades\Route::current()->action['as'];

                $getMenu = listGetPermission(listAllMenu(), $permissionRoute);
                $printMenu = [];
                $prevType = 0;
                foreach ($getMenu as $index => $list) {
                    if ($prevType == $list['type'] && $prevType == 3) {
                        if (count($printMenu) > 0) {
                            unset($printMenu[$index - 1]);
                        }
                    }

                    $printMenu[] = $list;
                    $prevType = $list['type'];

                }

                $getRoleSuperAdmin = 0;
                $getRoleDeveloper = 0;

                $adminRole = session()->get('admin_role');
                if ($adminRole) {
                    $role = \Illuminate\Support\Facades\Cache::remember('role' . $adminRole, env('SESSION_LIFETIME'), function () use ($adminRole) {
                        return \App\Codes\Models\Role::where('id', '=', $adminRole)->first();
                    });
                    if ($role) {
                        $getPermissionData = json_decode($role->permission_data, TRUE);

                        $getRoleSuperAdmin = isset($getPermissionData['super_admin']) ? 1 : 0;
                        $getRoleDeveloper = isset($getPermissionData['check_all']) ? 1 : 0;
                    }
                }

                foreach ($printMenu as $value) {
                    $active = '';
                    $class = '';
                    foreach ($value['active'] as $getActive) {
                        if (strpos($getRoute, $getActive) === 0) {
                            $active = ' active';
                        }
                    }
                    if (isset($value['inactive'])) {
                        foreach ($value['inactive'] as $getInActive) {
                            if (strpos($getRoute, $getInActive) === 0) {
                                $active = '';
                            }
                        }
                    }

                    if ($value['type'] == 2 && strlen($active) > 0) {
                        $class .= ' nav-item has-treeview menu-open';
                        $extraLi = '<i class="right fa fa-angle-left"></i>';
                    } else if ($value['type'] == 2) {
                        $class .= ' nav-item has-treeview';
                        $extraLi = '<i class="right fa fa-angle-left"></i>';
                    } else {
                        $class .= 'nav-item';
                        $extraLi = '';
                    }

                    if (isset($value['route'])) {
                        $route = route($value['route']);
                    } else {
                        $route = '#';
                    }

                    $getIcon = $value['icon'] ?? '';
                    $getAdditional = $value['additional'] ?? '';
                    $html .= '<li class="' . $class . '">
                            <a href="' . $route . '" title="' . $value['name'] . '" class="nav-link' . $active . '">
                            ' . $getIcon . '
                            <p>' .
                        $value['title'] . $extraLi . $getAdditional . '</p></a>';

                    if ($value['type'] == 2) {
                        $html .= '<ul class="nav nav-treeview">';
                        $html .= getMenuChild($value['data'], $getRoute);
                        $html .= '</ul>';
                    }

                    $html .= '</a></li>';
                }
            }
        }
        return $html;
    }
}

if (!function_exists('getMenuChild')) {
    /**
     * @param $data
     * @param $getRoute
     * @return string
     */
    function getMenuChild($data, $getRoute): string
    {
        $html = '';

        foreach ($data as $value) {
            $active = '';
            foreach ($value['active'] as $getActive) {
                if (strpos($getRoute, $getActive) === 0) {
                    $active = 'active';
                }
            }
            if (isset($value['inactive'])) {
                foreach ($value['inactive'] as $getInActive) {
                    if (strpos($getRoute, $getInActive) === 0) {
                        $active = '';
                    }
                }
            }

            if (isset($value['route'])) {
                $route = route($value['route']);
            } else {
                $route = '#';
            }

            $html .= '<li class="nav-item">
                    <a href="' . $route . '" class=" nav-link ' . $active . '" title="' . $value['name'] . '">
                    <i class="fa fa-circle-o nav-icon"></i><p>' .
                $value['title'];
            $html .= '</p></a></li>';
        }

        return $html;
    }
}

if (!function_exists('getDetailPermission')) {
    function getDetailPermission($module, $permission = ['create' => false, 'edit' => false, 'show' => false, 'destroy' => false])
    {
        $adminRole = session()->get('admin_role');
        if ($adminRole) {
            $role = \Illuminate\Support\Facades\Cache::remember('role' . $adminRole, env('SESSION_LIFETIME'), function () use ($adminRole) {
                return \App\Codes\Models\Role::where('id', '=', $adminRole)->first();
            });
            if ($role) {
                $permissionData = json_decode($role->permission_data, TRUE);
                if (isset($permissionData[$module])) {
                    foreach ($permissionData[$module] as $key => $value) {
                        $permission[$key] = true;
                    }
                }
            }
        }
        return $permission;
    }
}

if (!function_exists('getValidatePermissionMenu')) {
    /**
     * @param $permission
     * @return array
     */
    function getValidatePermissionMenu($permission): array
    {
        $listMenu = [];
        if ($permission) {
            foreach ($permission as $key => $route) {
                if ($key == 'check_all') {
                    $listMenu['check_all'] = 1;
                } else if ($key == 'super_admin') {
                    $listMenu['super_admin'] = 1;
                } else {
                    if (is_array($route)) {
                        foreach ($route as $key2 => $route2) {
                            $listMenu[$key][$key2] = 1;
                        }
                    }
                }
            }
        }


        return $listMenu;
    }
}

if (!function_exists('generateListPermission')) {
    /**
     * @param array|null $data
     * @return string
     */
    function generateListPermission(?array $data = array()): string
    {
        $html = '';

        $value = isset($data['check_all']) ? 'checked' : '';
        $html .= '<label for="check_all">
                    <input ' . $value . ' style="margin-right: 5px;" type="checkbox" class="checkThis check_all"
                    data-name="check_all" name="permission[check_all]" value="1" id="check_all"/>
                    ALL
                </label><br/><br/>';
        $value = isset($data['super_admin']) ? 'checked' : '';
        $html .= '<label for="super_admin">
                    <input ' . $value . ' style="margin-right: 5px;" type="checkbox" class="super_admin"
                    data-name="super_admin" name="permission[super_admin]" value="1" id="super_admin"/>
                    Super Admin
                </label><br/><br/>';
        $html .= createTreePermission(listAllMenu(), 0, 'checkThis check_all', $data);
        return $html;
    }
}

if (!function_exists('createTreePermission')) {
    /**
     * @param $data
     * @param int $left
     * @param string $class
     * @param array|null $getData
     * @return string
     */
    function createTreePermission($data, int $left = 0, string $class = '', ?array $getData = array()): string
    {
        $html = '';
        foreach ($data as $index => $list) {
            if ($list['type'] == 2) {
                $html .= '<label>' . $list['name'] . '</label><br/>';
                $html .= createTreePermission($list['data'], $left + 1, $class, $getData);
            } else if ($list['type'] == 3) {
                $html .= '<hr/><label>' . $list['name'] . '</label><hr/>';
            } else {
                $value = isset($getData[$list['key']]) ? 'checked' : '';
                $html .= '<label for="checkbox-' . $index . '-' . $list['key'] . '">
                            <input ' . $value . ' style="margin-left: ' . ($left * 30) . 'px; margin-right: 5px;" type="checkbox"
                            class="' . $class . ' ' . $list['key'] . '" data-name="' . $list['key'] . '" name="permission[' . $list['key'] . ']"
                            value="1" id="checkbox-' . $index . '-' . $list['key'] . '"/>
                            ' . $list['name'] .
                    '</label><br/>';
                $html .= getAttributePermission($list['key'], $index, $left + 1, $class . ' ' . $list['key'], $getData);
                $html .= '<br/>';
            }
        }
        return $html;
    }
}

if (!function_exists('getAttributePermission')) {
    /**
     * @param $module
     * @param $index
     * @param $left
     * @param string $class
     * @param array|null $getData
     * @return string
     */
    function getAttributePermission($module, $index, $left, string $class = '', ?array $getData = array()): string
    {
        $html = '';
        $list = listAvailablePermission();
        if (isset($list[$module])) {
            foreach ($list[$module] as $key => $value) {
                $value = isset($getData[$module][$key]) ? 'checked' : '';
                $html .= '<label for="checkbox-' . $index . '-' . $module . '-' . $key . '">
                            <input ' . $value . ' style="margin-left: ' . ($left * 30) . 'px; margin-right: 5px;" type="checkbox"
                            class="' . $class . '" name="permission[' . $module . '][' . $key . ']" value="1"
                            id="checkbox-' . $index . '-' . $module . '-' . $key . '"/>
                            ' . $key .
                    '</label><br/>';
            }
        }
        return $html;
    }
}

if (!function_exists('getPermissionRouteList')) {
    /**
     * @param $listMenu
     * @return array
     */
    function getPermissionRouteList($listMenu): array
    {
        $listAllowed = [];
        $listPermission = listAvailablePermission();
        foreach ($listPermission as $key => $list) {
            if ($key == 'super_admin')
                continue;
            foreach ($list as $key2 => $listRoute) {
                if (isset($listMenu[$key][$key2])) {
                    foreach ($listRoute as $value) {
                        $listAllowed[] = $value;
                    }
                }
            }
        }
        return $listAllowed;
    }
}

if (!function_exists('listGetPermission')) {
    /**
     * @param $listMenu
     * @param $permissionRoute
     * @return array
     */
    function listGetPermission($listMenu, $permissionRoute): array
    {
        $result = [];
        if ($permissionRoute) {
            foreach ($listMenu as $list) {
                if ($list['type'] == 1) {
                    if (in_array($list['route'], $permissionRoute)) {
                        $result[] = $list;
                    }
                } else if ($list['type'] == 3) {
                    $result[] = $list;
                } else {
                    $getResult = listGetPermission($list['data'], $permissionRoute);
                    if (count($getResult) > 0) {
                        $list['data'] = $getResult;
                        $result[] = $list;
                    }
                }
            }
        }

        return $result;
    }
}
