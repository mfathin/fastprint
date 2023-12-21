<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Status;
use GuzzleHttp\Exception\RequestException;
use PhpParser\Node\Stmt\TryCatch;

class FetchApi extends Controller
{
    public function fetchApi()
    {
        $client = new Client();

        $username = 'tesprogrammer191223C04';

        // $currentDate = date('d');
        // $currentMonth = date('m');
        // $currentYear = date('y');

        $password = md5('bisacoding-19-12-23');

        $body = [
            'username' => $username,
            'password' => $password,
        ];

        // $getResponse = $response->getBody()->getContents();

        try {
            $response = $client->request('POST', 'https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
                'form_params' => $body,
            ]);

            $getStatusCode = $response->getStatusCode();

            if ($getStatusCode == 200) {

                $responseData = json_decode($response->getBody()->getContents(), true);

                foreach ($responseData['data'] as $item) {

                    // Menyimpan Data Produk
                    $produk = new Produk();
                    $produk->nama_produk = $item['nama_produk'];
                    $produk->harga = $item['harga'];
                    $produk->kategori_id = $item['kategori'];
                    $produk->status_id = $item['status'];
                    $produk->save();


                    // Menyimpan Data Kategori
                    $kategoris = [];

                    $kategori = $item['kategori'];

                    if (!in_array($kategori, $kategoris)) {

                        // Store the encountered category
                        $categories[] = $kategori;

                        // Insert category if not exists
                        $existingCategory = Kategori::where('nama_kategori', $kategori)->first();
                        if (!$existingCategory) {
                            $newCategory = new Kategori();
                            $newCategory->nama_kategori = $kategori;
                            $newCategory->save();
                        }
                    }

                    // Menyimpan Data Status
                    $statuss = [];

                    $status = $item['status'];

                    if (!in_array($status, $statuss)) {

                        // Store the encountered category
                        $statuss[] = $status;

                        // Insert category if not exists
                        $existingStatus = Status::where('nama_status', $status)->first();
                        if (!$existingStatus) {
                            $newStatus = new Status();
                            $newStatus->nama_status = $status;
                            $newStatus->save();
                        }
                    }

                    return 'Data Berhasil Disimpan';
                }
            } else {
                echo "Unexpected status code: $response";
            }
        } catch (RequestException $e) {
            echo "Request Exception: " . $e->getMessage();
        }
    }
}
