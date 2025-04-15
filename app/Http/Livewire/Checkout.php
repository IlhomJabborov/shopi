<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public function makeOrder(Request $request)
    {
        // Buyurtma uchun ma'lumotlarni tasdiqlash
        $validatedRequest = $request->validate([
            'country' => 'required',
            'billing_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'zipcode' => 'required|numeric',
            'order_notes' => '',
        ]);

        $user = Auth::user();
        
        // Foydalanuvchi billingDetails ni saqlash
        if ($user->billingDetails === null) {
            $user->billingDetails()->create($validatedRequest);
        } else {
            $user->billingDetails()->update($validatedRequest);
        }

        // Yangi buyurtma yaratish va bazaga saqlash
        $total = str_replace(',', '', Cart::total());
        $order = new Order([
            'user_id' => $user->id,
            'status' => 'completed', // Buyurtma holati
            'total' => $total,
        ]);
        $order->save();

        foreach (Cart::content() as $item) {
            $price = str_replace(',', '', $item->price);
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'price' => $price
            ]);
            $orderItem->save();
        }

        // Savatchani bo'shatish
        Cart::destroy();

        // Foydalanuvchini base sahifasiga yo'naltirish
        return redirect()->route('base')->with('success', 'Buyurtmangiz muvaffaqiyatli saqlandi!');
    }

    public function render()
    {
        if (Cart::count() <= 0) {
            session()->flash('error', 'Savatingiz bo\'sh.');
            return redirect()->route('home');
        }
        
        $user = Auth::user();
        $billingDetails = $user->billingDetails;
        
        return view('livewire.checkout', compact('billingDetails'));
    }
}