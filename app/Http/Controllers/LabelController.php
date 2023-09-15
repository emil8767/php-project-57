<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::orderBy('id')->paginate();
        return view('labels.index', compact('labels'));
    }

    public function create(Label $label)
    {
        $this->authorize('create', $label);
        return view('labels.create', ['label' => $label]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Label::class);
        $label = new Label();
        $data = $this->validate($request, [
            'name' => 'required|unique:labels',
            'description' => 'nullable']);

        $label->fill($data);
        $label->save();
        return redirect()
            ->route('labels.index')->with('success', 'Метка успешно создана');
    }

    public function edit(Label $label)
    {
        $this->authorize('update', $label);
        return view('labels.edit', ['label' => $label]);
    }

    public function update(Request $request, Label $label)
    {
        $this->authorize('update', $label);
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name,' . $label->id,
            'description' => 'nullable']);
        $label->fill($data);
        $label->save();
        return redirect()
            ->route('labels.index')->with('success', 'Метка успешно изменена');
    }

    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);
        if ($label) {
            $label->delete();
        }
        return redirect()->route('labels.index')->with('success', 'Метка успешно удалена');
    }
}
