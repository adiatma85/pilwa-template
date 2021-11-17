<?php

namespace App\Http\Controllers\Traits;

use Goutte\Client;

trait SiamAuthTrait
{

    private $crawlerAccessEndpoints = 'https://siam.ub.ac.id/';

    public function siamAuth($credentials)
    {
        $nim = $credentials['nim'];
        $password = $credentials['password'];

        $client = new Client();

        $crawler = $client->request('GET', $this->crawlerAccessEndpoints);
        $form = $crawler->selectButton('Masuk')->form();
        $crawler = $client->submit($form, ['username' => $nim, 'password' => $password]);

        // Check if any error exist
        $check = $crawler->filter('small.error-code')->each(function ($result) {
            return $result->text();
        });

        if (isset($check[0])) {
            $response = [
                'data' => null,
                'msg' => 'nim or password is wrong',
                'success' => false,
            ];
        } else {
            $data = $crawler->filter('div[class="bio-info"] > div')->each(function ($result) {
                return $result->text();
            });

            $name = $data[1];
            $fakultas = substr($data[2], 19);
            $jurusan = substr($data[3], 7);
            $prodi = substr($data[4], 13);

            $data = [
                'nim' => $nim,
                'name' => $name,
                'fakultas' => $fakultas,
                'jurusan' => $jurusan,
                'prodi' => $prodi
            ];

            $response = [
                'data' => $data,
                'msg' => 'success login',
                'success' => true,
            ];
        }

        return (object) $response;
    }
}
