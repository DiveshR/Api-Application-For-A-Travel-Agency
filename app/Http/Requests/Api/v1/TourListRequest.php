<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'priceFrom' => ['numeric'],
            'priceTo' => ['numeric'],
            'dateFrom' => ['date'],
            'dateTo' => ['date'],
            'sortBy' => Rule::in(['price']),
            'sortOrder' => Rule::in(['asc','desc']),    
        ];
    }

    public function messages(){
        return [
            'sortBy' => "The 'sortBy' parameter only accepts 'price' value",
            'sortOrder' => "The 'sortOrder' parameter only accepts 'asc' or 'desc' value ",
        ];
    }
}
