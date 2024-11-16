<?php

namespace App\Service;

use Illuminate\Support\Collection;

class CsvExportService
{
    public function generateCsv(string $fileName, array $headers, Collection $data): string
    {
        $filePath = storage_path($fileName);
        $csvFile = fopen($filePath, 'wb');

        // Write headers
        fputcsv($csvFile, $headers);

        // Write data rows
        foreach ($data as $row) {
            fputcsv($csvFile, $row);
        }

        fclose($csvFile);

        return $filePath;
    }
}
