<?php

namespace App\Http\Controllers;

use App\Service\CsvExportService;
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
