<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\City;
use App\Models\DeliveryCharge;
use App\Models\Enquiry;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Promocode;
use App\Models\State;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class SiteController extends Controller
{
    /*==================================================>
    /===============Splash Page ==========================>
    /==================================================*/
    public function index()
    {
        return view('site.splash');
    }
    /*==================================================>
    /===============Home Page ==========================>
    /==================================================*/
    public function home()
    {
        $testimonials = Testimonial::where('status', 'active')->get();
        return view('site.home', compact('testimonials'));
    }
    /*==================================================>
    /===============About Page ==========================>
    /==================================================*/
    public function about()
    {
        return view('site.about');
    }
    /*==================================================>
    /===============Contact Page ==========================>
    /==================================================*/
    public function contact()
    {
        return view('site.contact');
    }
    /*==================================================>
    /==============Contact Request Page ================>
    /==================================================*/
    public function contactRequest(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'message' => 'nullable|max:10000'
        ]);

        Enquiry::create([
            'name' => $request->firstname . ' ' .  $request->lastname,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return response([
            'success' => 'Thank you! we will get back to you soon'
        ]);
    }
    /*==================================================>
    /===============FAQs Page ==========================>
    /==================================================*/
    public function faq(Request $request)
    {
        return view('site.faq');
        $request->validate([
            'rolt_id' => 'required_if:auth()->id(),is_admin'
        ]);
    }
    /*==================================================>
    /===============Blog Page ==========================>
    /==================================================*/
    public function blog()
    {
        return view('site.blog');
    }
    /*==================================================>
    /===============Blog detail Page====================>
    /==================================================*/
    public function blogDetail()
    {
        return view('site.blog-detail');
    }
    /*==================================================>
    /===============Product Page =======================>
    /==================================================*/
    public function product()
    {
        $products = Product::with('images')->when(auth()->user()?->id, function ($query) {
            $query->withCount(['liked_by' => function ($q) {
                $q->where('wishlists.user_id', auth()->user()->id);
            }]);
        })->where('status', 'active')->get();
        return view('site.product', compact('products'));
    }
    /*==================================================>
    /===============Product Detail Page ================>
    /==================================================*/
    public function productDetail(Request $request, $slug)
    {
        $product = Product::with(['images'])->where('slug', $slug)
            ->when(auth()->user()?->id, function ($query) {
                $query->withCount(['liked_by' => function ($q) {
                    $q->where('wishlists.user_id', auth()->user()->id);
                }]);
            })->first();
        return view('site.product-detail', compact('product'));
    }
    /*==================================================>
    /===============Cart Page ================>
    /==================================================*/
    public function getCartData(Request $request)
    {
        if (Auth::check()) {
            $carts = Cart::with(['product.images', 'user'])->where('user_id', auth()->user()->id)->get();
            $cart_html = view('components.site.misc.nav-cart', compact('carts'))->render();

            return response([
                'html' => $cart_html,
                'count' => $carts,
            ]);
        } else {
            $cookie_cart = json_decode($request->cookie('cart'), true);
            if (!empty($cookie_cart)) {
                foreach ($cookie_cart as $key => $cart) {
                    // return $cart;
                    $product = Product::with(['images'])->findOrFail($cart['product_id']);
                    $product->quantity = $cart['quantity'];
                    $carts[] = $product;
                }

                $cart_html = view('components.site.misc.nav-cart', compact('carts'))->render();
                return response([
                    'html' => $cart_html,
                    'count' => $carts,
                ]);
            }
        }
    }
    public function cart(Request $request)
    {
        $carts = [];
        if (Auth::check()) {
            $user = auth()->user();
            $carts = Cart::with(['product.images'])->get();
        }
        return view('site.cart', compact('carts'));
    }
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id|numeric',
            'quantity' => 'nullable|numeric'
        ]);
        // return $request->all();

        if (Auth::check()) {
            if (Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->first()) {
                return response([
                    'success' => 'Already added in your card!'
                ]);
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'quantity' => ($request->quantity) ?? 1,
                ]);
            }
            return response([
                'success' => 'Product added to your card!'
            ]);
        } else {

            $cart = $request->cookie('cart');

            if (!$cart) {
                $cart[] = [
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity ?? 1
                ];

                $response = new Response([
                    'success' => 'Product added to your cart!'
                ]);
                $response->withCookie(cookie()->forever('cart', json_encode($cart)));
                return $response;
            }
            if (isset($cart)) {
                $cart1 = json_decode($cart);

                $newCart[] = [
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity ?? 1,
                ];

                $flag = 0;

                foreach ($cart1 as $key => $c) {
                    if ($c->product_id == $newCart[0]['product_id']) {
                        $flag = 1;
                        $response = new Response([
                            'success' => 'Product already added to your cart',
                        ]);
                        return $response;
                    }
                }
                if ($flag = 0) {
                    $data = array_merge_recursive($cart1, $newCart);
                    $response = new Response([
                        'success' => 'Product added to your cart'
                    ]);
                    $response->withCookie(cookie()->forever('cart', json_encode($data)));
                    return $ersponse;
                }
            }
        }
    }
    public function updateCard(Request $request)
    {
        $request->validate([
            'id' => 'nullable|numeric|exists:carts,id',
            'quantity' => 'numeric|required',
        ]);
        // return $request->all();

        if ($request->product_id) {
            $cart = Cart::where('product_id', $request->product_id)->where('user_id', auth()->user()->id)->update([
                'quantity' => $request->quantity
            ]);
            if ($cart) {
                return response([
                    'success' => 'Product quantity updated!',
                ]);
            } else {
                return response([
                    'error' => 'Opps! Product not in your cart!'
                ]);
            }
        }
        $cart = Cart::findOrFail($request->id)->update([
            'quantity' => $request->quantity
        ]);
        return response([
            'success' => 'Product quantity updated!',
        ]);
    }
    public function deleteCardItem(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carts,id',
        ]);
        $user = auth()->user();

        $cart = $user->cart()->where('id', $request->id)->delete();
        return response([
            'success' => 'Removed successfully!'
        ]);
    }
    public function clearCart(Request $request)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->get();

        $cart->each->delete();

        return response([
            'success' => 'Your cart cleared successfully!'
        ]);
    }
    /*==================================================>
    /=================checkout Page ====================>
    /==================================================*/
    public function checkout()
    {
        $carts = [];
        $states = State::India()->get();
        $cities = City::India()->get();
        $deliveryCharges = DeliveryCharge::all();
        foreach ($deliveryCharges as $data) {
            $info[] = [
                $data->key => $data->value,
            ];
        }
        $deliveryCharges = (!$deliveryCharges->isEmpty()) ? (array_merge(...$info)) : [];
        if (Auth::check()) {
            $user = auth()->user();
            $carts = Cart::with(['product.images'])->where('user_id', $user->id)->get();
        }
        return view('site.checkout', compact('carts', 'states', 'cities', 'deliveryCharges'));
    }
    public function promocodeValidate(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        // return $request->all();

        auth()->id();
        if (Auth::check()) {
            $carts = Cart::with(['product'])->where('user_id', auth()->id())->get();
            $sum = 0;
            foreach ($carts as $key => $cart) {
                $sum += $cart->product->discounted_price * $cart->quantity;
            }

            $promocode = Promocode::whereDate('end_date', '>=', date('Y-m-d'))
                ->where('status', 'active')
                ->where('promocode', $request->code)
                ->first();
            if ($promocode) {
                if ($sum >= $promocode->minimum_order_amount) {
                    if ($promocode->discount_type == 'percentage') {
                        $discount_calculate = ($sum * ($promocode->discount) / 100);

                        $discount = ($discount_calculate <= $promocode->max_discount_amount) ? $discount_calculate : $promocode->max_discount_amount;
                        $final_total = $sum - $discount;
                        return response([
                            'success' => 'Promocode applied!',
                            'discount' => $discount,
                            'final_total' => $final_total,
                            'promocode' => $promocode->promocode
                        ]);
                    } else {
                        $discount = ($promocode->discount);
                        $final_total = $sum - $discount;
                        return response([
                            'success' => 'Promocode applied!',
                            'discount' => $discount,
                            'final_total' => $final_total
                        ]);
                    }
                } else {
                    return response([
                        'error' => 'Invalid promocode!',
                        'final_total' => $sum
                    ]);
                }
            }
        } else {
            return response([
                'error' => 'Login to apply promocode',
            ]);
        }
    }
    /*==================================================>
    /=================Wishlist page Page ====================>
    /==================================================*/
    public function wishlist()
    {
        // auth()->id();
        $wishlists = Wishlist::with(['user', 'product:id,title,manufacturer,made_in,discounted_price,in_stock,slug' => ['images']])->where('user_id', auth()->id())->get();

        return view('site.wishlist', compact('wishlists'));
    }
    public function addWishlist(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        // return $request->all();
        $prod_check = Wishlist::where('product_id', $request->id)->where('user_id', auth()->id())->first();


        if (Auth::check()) {
            if (!$prod_check) {
                Wishlist::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->id,
                ]);
                return response([
                    'success' => 'Product added to your wishlist'
                ]);
            } else {
                $prod_check = Wishlist::where('product_id', $request->id)->where('user_id', auth()->id())->delete();
                return response([
                    'success' => 'Product removed from your wishlist'
                ]);
            }
        } else {
            return response([
                'error' => 'Login to add your wishlist'
            ]);
        }
    }
    public function removeWishlist(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:wishlists,id',
        ]);
        // return $request->all();
        $prod_check = Wishlist::where('id', $request->id)->where('user_id', auth()->id())->delete();

        return response([
            'success' => 'Product Removed...',
        ]);
    }

    /*==================================================>
    /===========Global search for product ===========>
    /==================================================*/
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = Product::with(['images'])->latest()->filter(request(['search']))->where('status', 'active')->get();
            $html = view('components.site.misc.search', compact('products'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('email', $user->email)->first();

            if (!empty($finduser)) {
                Auth::login($finduser);

                $cookie_cart = json_decode($request->cookie('cart'));
                if (!empty($cookie_cart)) {
                    foreach ($cookie_cart as $key => $cart) {
                        $cart = Cart::create([
                            'product_id' => $cart->product_id,
                            'user_id' => auth()->user()->id,
                            'quantity' => $cart->quantity
                        ]);
                    }
                    Cookie::queue(Cookie::forget('cart'));
                }

                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('1234dummy')
                ]);

                Auth::login($newUser);
                $cookie_cart = json_decode($request->cookie('cart'));
                if (!empty($cookie_cart)) {
                    foreach ($cookie_cart as $key => $cart) {
                        $cart = Cart::create([
                            'product_id' => $cart->product_id,
                            'user_id' => auth()->user()->id,
                            'quantity' => $cart->quantity
                        ]);
                    }
                    Cookie::queue(Cookie::forget('cart'));
                }


                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('/');
    }
}
