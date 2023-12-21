<?php

namespace App\Http\Controllers;

use App\Repositories\HotpointRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * @param HotpointRepository $hotpointRepository
     * @return Response
     */
    public function index(HotpointRepository $hotpointRepository): Response
    {
        $hotpoints = $hotpointRepository->getAll();

        return Inertia::render('Home', compact('hotpoints'));
    }
}
