<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $customer = Auth::guard('customer')->user();
        return view('profile.show', compact('customer'));
    }

    public function edit()
    {
        $customer = Auth::guard('customer')->user();
        return view('profile.edit', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $customer->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah!');
    }

    public function orders()
    {
        $customer = Auth::guard('customer')->user();
        $orders = $customer->orders()->with(['shoe', 'shoeSize'])->latest()->paginate(10);
        return view('profile.orders', compact('orders'));
    }
}
