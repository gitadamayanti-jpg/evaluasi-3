<?php

namespace App\Http\Controllers;

use App\Models\Digicam;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('frontpage.cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $digicam = Digicam::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                'id' => $digicam->id,
                'nama' => $digicam->nama,
                'merek' => $digicam->merek,
                'harga' => $digicam->harga,
                'foto' => $digicam->foto,
                'jumlah' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        foreach ($request->jumlah as $id => $jumlah) {
            if (isset($cart[$id])) {
                $cart[$id]['jumlah'] = (int) $jumlah;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('frontpage.checkout', compact('cart', 'total'));
    }

    public function storeCheckout(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:1000',
            'metode_pembayaran' => 'required|in:Transfer Bank,E-Wallet,COD',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $checkout = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'cart' => $cart,
            'total' => $total,
        ];

        session()->put('checkout', $checkout);
        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        $checkout = session()->get('checkout');

        if (!$checkout) {
            return redirect()->route('cart.index');
        }

        return view('frontpage.checkout-success', compact('checkout'));
    }
}