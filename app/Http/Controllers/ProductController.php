<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpsertCashLoanRequest;
use App\Http\Requests\Product\UpsertHomeLoanRequest;
use App\Models\Product;
use App\Service\CsvExportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    public function __construct(private readonly CsvExportService $csvExportService)
    {
    }

    public function index(): View
    {
        $products = Auth::user()?->products()->orderBy('created_at', 'DESC')->get();

        return view('product.index', compact('products'));
    }

    public function upsertCashLoan(UpsertCashLoanRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        $product->upsert(
            values: [
                [
                    'cash_loan_amount' => $validated['cash_loan_amount'] * 100,
                    'type' => $validated['type'],
                    'client_id' => $validated['client_id'],
                    'adviser_id' => $validated['adviser_id'],
                ],
            ],
            uniqueBy: ['client_id', 'type'],
            update: ['cash_loan_amount'],
        );

        return redirect('/clients');
    }

    public function upsertHomeLoan(UpsertHomeLoanRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        $product->upsert(
            values: [
                [
                    'property_value' => $validated['property_value'] * 100,
                    'down_payment_amount' => $validated['down_payment_amount'] * 100,
                    'type' => $validated['type'],
                    'client_id' => $validated['client_id'],
                    'adviser_id' => $validated['adviser_id'],
                ],
            ],
            uniqueBy: ['client_id', 'type'],
            update: ['property_value', 'down_payment_amount'],
        );

        return redirect('/clients');
    }

    public function exportCsv(): BinaryFileResponse
    {
        $products = Auth::user()?->products()->orderBy('created_at', 'DESC')->get();

        $csvFileName = sprintf('report_%s.csv', now()->format('Y-m-d'));

        $headers = [
            'ClientName',
            'Product type',
            'Product value',
            'Created',
        ];

        $data = $products->map(fn($product) => [
            sprintf('%s %s', $product->client->first_name, $product->client->last_name),
            $product->type,
            $product->productValue,
            $product->created_at->format('Y-m-d'),
        ]);

        $filePath = $this->csvExportService->generateCsv(
            fileName: $csvFileName,
            headers: $headers,
            data: $data
        );

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
