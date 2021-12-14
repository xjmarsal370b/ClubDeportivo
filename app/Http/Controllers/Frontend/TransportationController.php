<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransportationRequest;
use App\Http\Requests\StoreTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;
use App\Models\Transportation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransportationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transportation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportations = Transportation::all();

        return view('frontend.transportations.index', compact('transportations'));
    }

    public function create()
    {
        abort_if(Gate::denies('transportation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.transportations.create');
    }

    public function store(StoreTransportationRequest $request)
    {
        $transportation = Transportation::create($request->all());

        return redirect()->route('frontend.transportations.index');
    }

    public function edit(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.transportations.edit', compact('transportation'));
    }

    public function update(UpdateTransportationRequest $request, Transportation $transportation)
    {
        $transportation->update($request->all());

        return redirect()->route('frontend.transportations.index');
    }

    public function show(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.transportations.show', compact('transportation'));
    }

    public function destroy(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportation->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransportationRequest $request)
    {
        Transportation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
