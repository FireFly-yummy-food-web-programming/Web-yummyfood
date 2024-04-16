<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Favorite;
class HomeController extends Controller
{
    public function index(Request $request)
{
    $listDish = DB::table('dish')->limit(10)->get();
    $allDish = DB::table('dish')->get();
    $listRandom = DB::table('dish')->inRandomOrder()->limit(10)->get();
    $listRandomPromotion = DB::table('dish')->where('discount', '>', 1)->inRandomOrder()->limit(10)->get(); 
    $listDishId = session()->get('favoriteId', []);
    // get banner
    $bigBanner = DB::table('banners')->get();
    //get category
    $category =DB::table('category')->get();

    if (session()->has('favoriteNewId')) {
        $favoriteNewId = session()->get('favoriteNewId');
        if (!in_array($favoriteNewId, $listDishId)) {
            $listDishId[] = $favoriteNewId; 
            session()->put('favoriteId', $listDishId); 
        }
    }
    return view('clients.home', compact('listDish', 'allDish', 'listRandom', 'listRandomPromotion', 'listDishId','bigBanner','category'));
}
    public function isFavorite($user_id, $dish_id){
        $isFavorite = DB::table('favorites')
                        ->where('user_id', $user_id)
                        ->where('dish_id', $dish_id)
                        ->exists();
        return $isFavorite;
    
    }
    // function add to cart
    public function cart()
    {
        return view('clients.cart');
    }
    public function addToCart($id)
    {
        $dish = Dish::findOrFail($id);
 
        $cart = session()->get('cart', []);
 
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "dish_name" => $dish->dish_name,
                "image_dish" => $dish->image_dish,
                "price" => $dish->price,
                "discount" => $dish->discount,
                "quantity" => 1
            ];
        }
 
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }
 
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }    
}
