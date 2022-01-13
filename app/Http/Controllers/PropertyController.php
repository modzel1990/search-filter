<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $properties = Property::with(['location', 'booking'])->paginate(5);

        return view('search-filter', ['properties' => $properties]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $searchString = null;
        $acceptsPets = null;
        $nearTheBeach = null;
        $sleeps = null;
        $beds = null;

        if($request->search) {
            $searchString = $request->search;
        }
        if($request->accepts_pets) {
            $acceptsPets = $request->accepts_pets;
        }
        if($request->near_beach) {
            $nearTheBeach = $request->near_beach;
        }
        if($request->sleeps && $request->sleeps !== 'Sleeps') {
            $sleeps = $request->sleeps;
        }
        if($request->beds && $request->beds !== 'Beds') {
            $beds = $request->beds;
        }

        $properties = Property::with(['location', 'booking'])
            ->when($searchString, function ($query) use ($searchString) {
                return $query->whereHas('location', function ($query) use ($searchString) {
                    $wildCard = '%' . $searchString . '%';
                    $query->where('location_name', 'LIKE', $wildCard);
                });
            })
            ->when($acceptsPets, function ($query) use ($acceptsPets) {
                return $query->where('accepts_pets', $acceptsPets);
            })
            ->when($nearTheBeach, function ($query) use ($nearTheBeach) {
                return $query->where('near_beach', $nearTheBeach);
            })
            ->when($sleeps, function ($query) use ($sleeps) {
                return $query->where('sleeps', '>=', $sleeps);
            })
            ->when($beds, function ($query) use ($beds) {
                return $query->where('beds', '>=', $beds);
            })->paginate(5);

        return view('search-filter', ['properties' => $properties]);
    }
}
