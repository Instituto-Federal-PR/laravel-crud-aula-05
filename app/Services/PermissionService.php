<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends BaseService {

    public function __construct(protected PermissionRepository $repository) {}

    protected function getRepository(): mixed {
        return $this->repository;
    }

    public function loadPermissions($role) {

        $arr_permissions = Array();
        $perm = $this->repository->list(['resource'], ['field' => 'role_id', 'value' => $role], 'resource_id');

        foreach($perm as $item) {
            $arr_permissions[$item->resource->name] = true;
        }
        // dd($arr_permissions);
        session(['user_permissions' => $arr_permissions]);
    }

    public function isAuthorized($resource) {
        $permissions = session('user_permissions');

        if(array_key_exists($resource, $permissions)) {
            return true;
        }
        return false;
    }
}
