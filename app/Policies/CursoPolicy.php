<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use App\Services\PermissionService;

class CursoPolicy {

    public function __construct(protected PermissionService $service) {}

    public function viewAny(User $user): bool {
        return $this->service->isAuthorized('curso.index');
    }

    public function view(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.show');
    }

    public function create(User $user): bool {
         return $this->service->isAuthorized('curso.create');
    }

    public function update(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.edit');

    }

    public function delete(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.delete');

    }
    public function restore(User $user, Curso $curso): bool {
        return $this->service->isAuthorized('curso.delete');
    }

    public function forceDelete(User $user, Curso $curso): bool
    {
        return $this->service->isAuthorized('curso.delete');
    }
}
