<?php

namespace App\Policies;

use App\Models\Disciplina;
use App\Models\User;
use App\Services\PermissionService;

class DisciplinaPolicy {

    public function __construct(protected PermissionService $service) {}

    public function viewAny(User $user): bool {
        return $this->service->isAuthorized('disciplina.index');
    }

    public function view(User $user, Disciplina $disciplina): bool {
        return $this->service->isAuthorized('disciplina.show');
    }

    public function create(User $user): bool {
        return $this->service->isAuthorized('disciplina.create');
    }

    public function update(User $user, Disciplina $disciplina): bool {
        return $this->service->isAuthorized('disciplina.edit');
    }

    public function delete(User $user, Disciplina $disciplina): bool {
        return $this->service->isAuthorized('disciplina.delete');
    }

    public function restore(User $user, Disciplina $disciplina): bool {
        return $this->service->isAuthorized('disciplina.delete');
    }

    public function forceDelete(User $user, Disciplina $disciplina): bool {
        return $this->service->isAuthorized('disciplina.delete');
    }
}
