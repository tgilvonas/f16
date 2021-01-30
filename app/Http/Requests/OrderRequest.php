<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'print_format' => 'required|numeric',
            'print_type' => 'required|numeric',
            'flyer_logo' => 'required_if:design_needed,1',
            'flyer_layout_file' => 'required_unless:design_needed,1'
        ];
    }
}
