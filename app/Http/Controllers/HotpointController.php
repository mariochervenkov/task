<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotpointRequest;
use App\Models\Hotpoint;
use App\Repositories\HotpointRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HotpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param HotpointRepository $hotpointRepository
     * @return Response
     */
    public function index(HotpointRepository $hotpointRepository): Response
    {
        $hotpoints = $hotpointRepository->getAll();

        return Inertia::render('Hotpoints/Index', compact('hotpoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function create(ProductRepository $productRepository): Response
    {
        $products = $productRepository->getAll();

        return Inertia::render('Hotpoints/CreateEdit', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HotpointRequest $request
     * @param HotpointRepository $hotpointRepository
     * @return RedirectResponse
     */
    public function store(HotpointRequest $request, HotpointRepository $hotpointRepository): RedirectResponse
    {
        $response = $hotpointRepository->createUpdate($request->validated());

        return redirect()->route('hotpoints.index')
            ->with($response->status, $response->message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hotpoint $hotpoint
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function edit(Hotpoint $hotpoint, ProductRepository $productRepository): Response
    {
        $products = $productRepository->getAll();

        return Inertia::render('Hotpoints/CreateEdit', compact('hotpoint','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HotpointRequest $request
     * @param Hotpoint $hotpoint
     * @param HotpointRepository $hotpointRepository
     * @return RedirectResponse
     */
    public function update(HotpointRequest $request, Hotpoint $hotpoint, HotpointRepository $hotpointRepository): RedirectResponse
    {
        $response = $hotpointRepository->createUpdate($request->validated(), $hotpoint);

        return redirect()->route('hotpoints.index')
            ->with($response->status, $response->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hotpoint $hotpoint
     * @param HotpointRepository $hotpointRepository
     * @return RedirectResponse
     */
    public function destroy(Hotpoint $hotpoint, HotpointRepository $hotpointRepository): RedirectResponse
    {
        $response = $hotpointRepository->delete($hotpoint);

        return redirect()->route('hotpoints.index')
            ->with($response->status, $response->message);
    }
}
