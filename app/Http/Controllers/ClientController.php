<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::all();

        return view('client.index', compact('clients'));
    }

    public function create(): View
    {
        return view('client.create');
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $client = new Client([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);
        $client->save();

        return redirect('/clients');
    }

    public function edit(Client $client): View
    {
        return view('client.edit', compact('client'));
    }

    public function update(StoreClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect('/clients');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();
        return redirect('/clients');
    }
}
