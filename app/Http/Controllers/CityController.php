<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug = '')
    {
        $cities = City::all();

        if($slug) {
            if (!$cities->contains('slug', $slug)) {
                abort(404);
            }
            
            Session::put('slug', $slug);
            $cities->firstWhere('slug', $slug)->selected = true;
        } elseif($slug = Session::get('slug')) {
            return redirect('/' . $slug, 301);
        }

        return view('cities', compact('cities'));
    }
}
