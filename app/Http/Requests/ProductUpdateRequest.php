<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'category_id' => 'required|exists:category,id',
        ];
    }

    public function commit($product)
    {
        $product->name = $this->get('name');
        $product->type = $this->get('type');
        $product->category_id = $this->get('category_id');

        $product->save();
    }
}
