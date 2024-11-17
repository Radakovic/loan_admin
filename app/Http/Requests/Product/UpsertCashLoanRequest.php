<?php

namespace App\Http\Requests\Product;

use App\Enum\ProductTypeEnum;
use App\Models\Adviser;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpsertCashLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $adviser = Auth::user();
        if (!$adviser instanceof Adviser) {
            return false;
        }

        return $adviser->id === $this->request->get('adviser_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $type = ProductTypeEnum::CASH_LOAN->value;
        return [
            'cash_loan_amount' => ['required', 'numeric', 'max:10000', 'min:1000'],
            'type' => ['required', 'in:' . $type],
            'client_id' => ['required', 'string'],
            'adviser_id' => ['required', 'string'],
        ];
    }
}
