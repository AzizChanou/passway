<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'event_category_id' => ['required'],
            // 'title' => ['required', 'min:10', 'max:50',],
            // 'start_date' => ['required', 'date'],
            // 'end_date' => ['required', 'date'],
            // 'time' => ['required'],
            // 'place' => ['required', 'min:10', 'max:255'],
            // 'description' => ['required', "min:50", 'max:255'],
            // 'picture' => ['nullable:mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }
}
