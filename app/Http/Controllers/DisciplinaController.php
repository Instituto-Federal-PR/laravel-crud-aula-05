<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Http\Requests\DisciplinaRequest;
use App\Services\CursoService;
use App\Services\DisciplinaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Override;

class DisciplinaController extends BaseController {

    protected array $view = [
        'index'     => 'disciplina.index',
        'create'    => 'disciplina.create',
        'store'     => 'disciplina.index',
        'show'      => 'disciplina.show',
        'edit'      => 'disciplina.edit',
        'update'    => 'disciplina.index',
        'destroy'   => 'disciplina.index'
    ];

    protected array $with = ['curso'];

    protected string $orderBy = 'nome';

    public function __construct(
        protected DisciplinaService $service,
        protected CursoService $cursoService,
        protected Disciplina $model,
    ) {}

    protected function getService(): mixed {
        return $this->service;
    }

    protected function getModel(): Model {
        return $this->model;
    }

    protected function getRequestClass(): string {
        return DisciplinaRequest::class;
    }

    #[Override]
    public function create() {
        Gate::authorize('create', $this->model);
        $cursos = $this->cursoService->all();
        return view($this->view['create'], compact(['cursos']));
    }

    #[Override]
    public function edit(string $id) {
        $row = $this->service->find($id);
        Gate::authorize('update', $row);

        if(isset($row)) {
            $cursos = $this->cursoService->all();
            return view($this->view['edit'], compact(['row', 'cursos']));
        }

        return "<h1>Não encontrado!</h1>";
    }
}
