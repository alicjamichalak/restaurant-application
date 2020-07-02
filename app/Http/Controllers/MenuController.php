<?php

namespace App\Http\Controllers;

use App\FoodType;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    /**
     * RestaurantMenuController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminIndex(Request $request)
    {
        $dishes = DB::table('menus')
                    ->join('food_types', 'menus.menu_food_type_id', '=', 'food_types.food_type_id')
                    ->select([
                        'menus.menu_id',
                        'menus.menu_name',
                        'menus.menu_preparation_time',
                        'menus.menu_price',
                        'menus.menu_active',
                        'food_types.food_type_name',
                    ])
                    ->orderBy('food_types.food_type_name', 'ASC')
                    ->paginate(5);
        return view('menu.admin.index', compact('dishes'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        $foodTypes = FoodType::all()->pluck('food_type_name','food_type_id');
        return view('menu.admin.create', compact('foodTypes'));
    }

    public function adminStore()
    {
        Menu::create($this->validateRequest());
        return redirect(route('admin.menu.index'));
    }

    public function adminDeactivateMenu(int $menuId)
    {
        $menu = Menu::where('menu_id', '=', $menuId)->firstOrFail();
        $menu->update(['menu_active' => false]);

        return redirect(route('admin.menu.index'));
    }

    public function adminActivateMenu(int $menuId)
    {
        $menu = Menu::where('menu_id', '=', $menuId)->firstOrFail();
        $menu->update(['menu_active' => true]);

        return redirect(route('admin.menu.index'));
    }

    public function adminEdit(int $menuId)
    {
        $menu = Menu::where('menu_id', '=', $menuId)->firstOrFail();
        $foodTypes = FoodType::all()->pluck('food_type_name','food_type_id');
        return view('menu.admin.edit', compact('menu', 'foodTypes'));
    }

    public function adminUpdate(Request $request, int $menuId)
    {
        $menu = Menu::where('menu_id', '=', $menuId)->firstOrFail();
        $menu->update($this->validateRequest());

        return redirect(route('admin.menu.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'menu_name' => ['required', 'sometimes'],
            'menu_preparation_time' => ['required', 'sometimes', 'date_format:H:i'],
            'menu_price' => ['required', 'sometimes', 'numeric', 'gt:0'],
            'menu_food_type_id' => ['required','sometimes','numeric', 'exists:food_types,food_type_id'],
        ]);
    }

    public function clientIndex(Request $request)
    {
        $foodTypes = FoodType::all();
        return view('menu.client.index', compact('foodTypes'));
    }


    public function clientShow(Request $request, int $foodTypeId)
    {
        $dishes = DB::table('menus')
            ->join('food_types', 'menus.menu_food_type_id', '=', 'food_types.food_type_id')
            ->select([
                'menus.menu_id',
                'menus.menu_name',
                'menus.menu_preparation_time',
                'menus.menu_price',
                'menus.menu_active',
                'food_types.food_type_name',
            ])->where('menus.menu_active', '=', '1')
            ->where('food_types.food_type_id', '=', $foodTypeId)
            ->orderBy('food_types.food_type_name', 'ASC')
            ->paginate(5);

        $foodTypes = FoodType::all();
        return view('menu.client.show', compact('dishes', 'foodTypes'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
