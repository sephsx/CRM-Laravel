<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

class ClientController extends Controller

{
    public function index()
    {
        $clients = Client::paginate(10);
        return view('client.index', compact('clients'));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
            $request->validate([
                'name' => 'required',
                'company_name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required'
            ]);
            Client::create($request->all());
            return redirect()->route('client.index')->with('success', 'Client created successfully.');
        }
    }


    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }


    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);
        $client->update($request->all());
        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }
}
