<?php

namespace App\Http\Requests\GiphyRequests;

use Illuminate\Foundation\Http\FormRequest;

class GiphySearchLatestRequest extends FormRequest
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
            'start_date' => 'required|date_format:Y-m-d H:i:s|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:start_date'
        ];
    }
    
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            
            
            'start_date.required' => 'Start date is required to perform this action',
            'start_date.date_format'  => 'This entry is expected to be a date:Y-m-d H:i:s',
            'start_date.before_or_equal' => 'Start date must be less than or equal end date',
            
            'end_date.required' => 'End date is required to perform this action',
            'end_date.date_format'   => 'This entry is expected to be a date:Y-m-d H:i:s',
            'end_date.after_or_equal' => 'End date must be greater than or equal to start date',
        
        ];
    }
}
