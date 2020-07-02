<?php

namespace App\Http\Controllers;

use App\FoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function adminIndex(Request $request)
    {
        $foodTypes = DB::table('food_types')
                    ->orderBy('food_type_id', 'ASC')
                    ->paginate(5);
        return view('food-types.admin.index', compact('foodTypes'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        return view('food-types.admin.create');
    }

    public function adminStore()
    {
        FoodType::create($this->validateRequest());
        return redirect(route('admin.food-type.index'));
    }

    public function adminEdit(int $foodTypeId)
    {
        $foodType = FoodType::where('food_type_id', '=', $foodTypeId)->firstOrFail();
        return view('food-types.admin.edit', compact('foodType'));
    }

    public function adminUpdate(Request $request, int $foodTypeId)
    {
        $foodType = FoodType::where('food_type_id', '=', $foodTypeId)->firstOrFail();
        $foodType->update($this->validateRequest());

        return redirect(route('admin.food-type.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'food_type_name' => ['required', 'sometimes', 'unique:food_types,food_type_name'],
        ]);
    }
}
