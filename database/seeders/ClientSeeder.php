<?php

namespace Database\Seeders;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ClientSeeder extends Seeder
{
    private const LOAN_TYPES = [
        0 => ['CASH'],
        1 => ['HOME'],
        2 => ['CASH', 'HOME'],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(30)->create();

        $advisers = Adviser::all();
        $clients = Client::all();
        foreach ($clients as $client) {
            $loanTypes = self::LOAN_TYPES[random_int(0, 2)];
            foreach ($loanTypes as $loanType) {
                $this->seedLoans(
                    loanType: $loanType,
                    client: $client,
                    advisers: $advisers
                );
            }
        }
    }

    /**
     * Generate {@see Loan} for each {@see Client}
     */
    private function seedLoans(
        string $loanType,
        Client $client,
        Collection $advisers
    ): void {
        $cashLoanAmount = null;
        $propertyValue = null;
        $downPaymentAmount = null;

        if ($loanType === 'HOME') {
            $propertyValue = random_int(100000, 1000000);
            $downPaymentAmount = round($propertyValue / 10);
        }
        if ($loanType === 'CASH') {
            $cashLoanAmount = random_int(1000, 10000);
        }

        $client->loans()->create([
            'type' => $loanType,
            'adviser_id' => $advisers->random()->id,
            'property_value' => $propertyValue,
            'down_payment_amount' => $downPaymentAmount,
            'cash_loan_amount' => $cashLoanAmount,
        ]);
    }
}
