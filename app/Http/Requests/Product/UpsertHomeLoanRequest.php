<?php

namespace App\Http\Requests\Product;

use App\Enum\ProductTypeEnum;
use App\Models\Adviser;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpsertHomeLoanRequest extends FormRequest
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
        $type = ProductTypeEnum::HOME_LOAN->value;
        return [
            'property_value' => ['required', 'numeric', 'max:1000000', 'min:10000'],
            'down_payment_amount' => ['required', 'numeric', 'max:100000', 'min:1000', 'lt:property_value'],
            'type' => ['required', 'in:' . $type],
            'client_id' => ['required', 'string'],
            'adviser_id' => ['required', 'string'],
        ];
    }
}
