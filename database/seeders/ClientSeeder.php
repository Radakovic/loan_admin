<?php

namespace Database\Seeders;

use App\Enum\ProductTypeEnum;
use App\Models\Adviser;
use App\Models\Client;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ClientSeeder extends Seeder
{
    private const PRODUCT_TYPES = [
        0 => [ProductTypeEnum::CASH_LOAN->value],
        1 => [ProductTypeEnum::HOME_LOAN->value],
        2 => [ProductTypeEnum::CASH_LOAN->value, ProductTypeEnum::HOME_LOAN->value],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(50)->create();

        $advisers = Adviser::all();
        $clients = Client::all();
        foreach ($clients as $client) {
            $loanTypes = self::PRODUCT_TYPES[random_int(0, 2)];
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
     * Generate {@see Product} for each {@see Client}
     */
    private function seedLoans(
        string $loanType,
        Client $client,
        Collection $advisers
    ): void {
        $cashLoanAmount = null;
        $propertyValue = null;
        $downPaymentAmount = null;

        if ($loanType === ProductTypeEnum::HOME_LOAN->value) {
            $propertyValue = random_int(1000000, 10000000);
            $downPaymentAmount = round($propertyValue / 10);
        }
        if ($loanType === ProductTypeEnum::CASH_LOAN->value) {
            $cashLoanAmount = random_int(100000, 1000000);
        }

        Product::factory()->create([
            'type' => $loanType,
            'adviser_id' => $advisers->random()->id,
            'client_id' => $client->id,
            'property_value' => $propertyValue,
            'down_payment_amount' => $downPaymentAmount,
            'cash_loan_amount' => $cashLoanAmount,
        ]);
//
//        $client->products()->create([
//            'type' => $loanType,
//            'adviser_id' => $advisers->random()->id,
//            'property_value' => $propertyValue,
//            'down_payment_amount' => $downPaymentAmount,
//            'cash_loan_amount' => $cashLoanAmount,
//        ]);
    }
}
