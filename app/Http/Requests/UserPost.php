<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPost extends FormRequest
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
        
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'division_id' => 'required',
                'district_id' => 'required',
                'thana_id' => 'required',
                'address' => 'nullable',
                'language.*' => 'required',
                'exam_id.*' => 'required',
                'board_id.*' => 'required',
                'university_id.*' => 'required',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'image' => 'required',
                // 'cv' => 'required|mimes:pdf,doc',
                'cv' => 'required',
                'training_name' => 'nullable',
                'training_details' => 'nullable',
    
        
        ];
    }
}
