<?php

namespace App\Service;

use Illuminate\Support\Collection;

interface CsvExportServiceInterface
{
    /**
     * Generate CSV file for given headers and data
     */
    public function generateCsv(string $fileName, array $headers, Collection $data): string;
}
