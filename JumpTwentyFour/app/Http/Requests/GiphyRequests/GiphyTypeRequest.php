<?php
    
    namespace App\Http\Requests\GiphyRequests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class GiphyTypeRequest extends FormRequest
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
        
        
        /** Get all of the input and files for the request.
         *
         * @param  array|mixed $keys
         *
         * @return array
         */
        public function all($keys = null)
        {
            $request['id'] = $this->route('id');
            
            return $request;
        }
        
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'id' => 'required|integer'
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
            ];
        }
    }
