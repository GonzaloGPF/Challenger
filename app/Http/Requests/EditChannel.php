<?php

namespace App\Http\Requests;

use App\Channel;
use Illuminate\Foundation\Http\FormRequest;

class EditChannel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('channel'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes',
            'description' => 'sometimes',
            'capacity' => 'sometimes|numeric',
            'language_id' => 'sometimes|exists:languages,id',
        ];
    }
}
