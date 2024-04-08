<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class exportFileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'initial_date' => 'required|date_format:Y-m-d H:i:s',
            'deadline' => 'required|date_format:Y-m-d H:i:s|after:initial_date',
        ];
    }
}
