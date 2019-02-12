<?php
    
    namespace App\Http\Requests\GiphyRequests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class GiphyPostSearchRequest extends FormRequest
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
                
                'id' => 'required|integer',
                'query' => 'required|string'
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
    
    
                'id.required' => 'Giphy Type Id is required to perform this action',
                'id.integer'  => 'This entry can only contain integer',
        
                'query.required' => 'Search Query is required',
                'query.string'   => 'This entry can only contain string',
    
            ];
        }
    }
