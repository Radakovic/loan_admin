<?php

namespace Tests\Unit\Service;

use App\Service\CsvExportService;
use Illuminate\Support\Facades\File;
use Tests\TestCase;


class CsvExportServiceTest extends TestCase
{
    private string $filePath;

    protected function tearDown(): void
    {
        if (isset($this->filePath) && File::exists($this->filePath)) {
            File::delete($this->filePath);
        }

        parent::tearDown();
    }

    /**
     * Test will show that service {@see CsvExportService} will generate correct file
     * with correct file content
     */
    public function testGenerateCsv(): void
    {
        $service = app(CsvExportService::class);

        $this->filePath = $service->generateCsv(
            fileName: 'test.csv',
            headers: ['column1', 'column2'],
            data: collect([
                ['testRow1Column1', 'testRow1Column2'],
                ['testRow2Column1', 'testRow2Column2'],
            ]),
        );

        self::assertFileExists($this->filePath);
        self::assertStringMatchesFormatFile(
            $this->filePath,
            "column1,column2\ntestRow1Column1,testRow1Column2\ntestRow2Column1,testRow2Column2\n"
        );
    }
}
