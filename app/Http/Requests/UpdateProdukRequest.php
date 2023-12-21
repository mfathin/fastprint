<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProdukRequest extends FormRequest
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
            'txtnamaproduk' => [
                'required',
                Rule::unique('produk', 'nama_produk')->ignore($this->id_produk, 'id_produk'),
                'max:100',
            ],
            'txtharga' => 'required|numeric|regex:/^\d{3,}$/',
            'txtkategori' => 'required',
            'txtstatus' => 'required',
        ];
    }

    public function messages()
    {
        return [

            // Nama Produk Messages
            'txtnamaproduk.required' => ':attribute Tidak Boleh Kosong',
            'txtnamaproduk.unique' => ':attribute Sudah Terdaftar',

            // Harga Messages
            'txtharga.required' => ':attribute Tidak Boleh Kosong',
            'txtharga.numeric' => ':attribute Harus Berupa Angka',
            'txtharga.regex' => ':attribute Tidak Boleh Kurang Dari 3 Angka',

            // Kategori Message
            'txtkategori.required' => ':attribute Tidak Boleh Kosong',

            // Status Message
            'txtstatus.required' => ':attribute Tidak Boleh Kosong',
        ];
    }

    public function attributes()
    {
        return [
            'txtnamaproduk' => 'Nama Produk',
            'txtharga' => 'Harga Produk',
            'txtkategori' => 'Kategori Produk',
            'txtstatus' => 'Status Produk',
        ];
    }
}
