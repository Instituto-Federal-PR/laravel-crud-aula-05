<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

abstract class BaseController extends Controller {

    protected array $view = [];
    protected array $with = [];
    protected array $where = [];
    protected string $orderBy = 'id';

    abstract protected function getService(): mixed;
    abstract protected function getModel(): Model;
    abstract protected function getRequestClass(): string;

    public function index() {
        Gate::authorize('viewAny', $this->getModel());
        $data = $this->getService()->all($this->with, $this->where, $this->orderBy);
        return view($this->view['index'], compact(['data']));
    }

    public function create() {
        Gate::authorize('create', $this->getModel());
        return view($this->view['create']);
    }

    public function store(Request $request) {
        Gate::authorize('create', $this->getModel());
        $request = app($this->getRequestClass());
        $this->getService()->store($request->validated());
        return redirect()->route($this->view['store']);
    }

    public function show(string $id) {
        $row = $this->getService()->find($id);
        Gate::authorize('view', $row);

        if(isset($row)) {
            return view($this->view['show'], compact(['row']));
        }

        return "<h1>Não encontrado!</h1>";
    }

    public function edit(string $id) {
        $row = $this->getService()->find($id);
        Gate::authorize('update', $row);

        if(isset($row)) {
            return view($this->view['edit'], compact(['row']));
        }

        return "<h1>Não encontrado!</h1>";
    }

    public function update(Request $request, string $id) {
        $row = $this->getService()->find($id);
        Gate::authorize('update', $row);

        if(isset($row)) {
            $request = app($this->getRequestClass());
            $row->update($request->validated());
            return redirect()->route($this->view['update']);
        }

        return "<h1>Não encontrado!</h1>";
    }

    public function destroy(string $id) {
        $row = $this->getService()->find($id);
        Gate::authorize('delete', $row);

        if(isset($row)) {
            $row->delete();
            return redirect()->route($this->view['destroy']);
        }

        return "<h1>Não encontrado!</h1>";
    }
}
