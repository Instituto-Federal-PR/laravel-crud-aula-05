<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Requests\CursoRequest;
use App\Services\CursoService;
use Illuminate\Database\Eloquent\Model;

class CursoController extends BaseController {

    protected array $view = [
        'index'     => 'curso.index',
        'create'    => 'curso.create',
        'store'     => 'curso.index',
        'show'      => 'curso.show',
        'edit'      => 'curso.edit',
        'update'    => 'curso.index',
        'destroy'   => 'curso.index',
        'audit'     => 'curso.audit',
    ];

    protected array $with = ['disciplina', 'aluno'];

    protected string $orderBy = 'nome';

    public function __construct(
        protected CursoService $service,
        protected Curso $model
    ) {}

    protected function getService(): mixed {
        return $this->service;
    }

    protected function getModel(): Model {
        return $this->model;
    }

    protected function getRequestClass(): string {
        return CursoRequest::class;
    }
}
