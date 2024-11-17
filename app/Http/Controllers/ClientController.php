<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Show list of all {@see Client}
     */
    public function index(): View
    {
        $clients = Client::all();

        return view('client.index', compact('clients'));
    }
    /**
     * Show form for creating new {@see Client}
     */
    public function create(): View
    {
        return view('client.create');
    }
    /**
     * Create new {@see Client}
     */
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
    /**
     * Show form for editing {@see Client}
     */
    public function edit(Client $client): View
    {
        $cashLoan = $client->cashLoanProduct;
        $homeLoan = $client->homeLoanProduct;
        $adviser = Auth::user();
        return view('client.edit', compact([
            'client',
            'cashLoan',
            'homeLoan',
            'adviser',
        ]));
    }
    /**
     * Update personal data of {@see Client}
     */
    public function update(StoreClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect('/clients');
    }
    /**
     * Soft delete {@see Client}
     */
    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();
        return redirect('/clients');
    }
}
