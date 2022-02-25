<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class BakasRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'namafile' => 'required',
            'kantor_id' => 'required',
            'file' => 'required|mimes:zip'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'kantor_id.required' => 'kantor belum dipilih',
            'file.required' => 'nama file harus nama kantor (ex: cab-kpo.zip)',
            'file.mimes' => 'file yang di upload harus berbentuk .zip'
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'namafile' => 'required',
            'kantor_id' => 'required',
            'file' => 'required|mimes:zip'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'kantor_id.required' => 'kantor belum dipilih',
            'file.required' => 'nama file harus nama kantor (ex: cab-kpo.zip)',
            'file.mimes' => 'file yang di upload harus berbentuk .zip'
        ];
    }
}
