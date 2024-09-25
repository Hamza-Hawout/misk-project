<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'offer_price' => 'required|numeric|min:0',
        ]);

        Offer::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'offer_price' => $request->offer_price,
        ]);

        return redirect()->back()->with('success', 'Your offer has been submitted successfully.');
    }

}
