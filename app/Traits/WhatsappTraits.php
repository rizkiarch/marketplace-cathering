<?php

namespace App\Traits;

trait WhatsappTraits
{
    public static function sendTextWatsapp($phone, $message)
    {
        // Membersihkan dan memformat nomor telepon
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;

        // Inisialisasi cURL
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.wapanels.com/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appkey' => '8d2315be-8b7a-4cd5-83e9-f0efa62927df',
                'authkey' => 'Fq5IJlsmpONlalb1infIDSsHPboViJx1w5hc2kwICtebIqj6Qv',
                'to' => $phone,
                'message' => $message,
                'sandbox' => 'false'
            ),
        ));

        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $responseArray = json_decode($response, true);
        \Log::info("Berhasil Mengirim Menggunakan Watsapid " . date('Y-m-d H:i:s'));
        return $responseArray['data'] ?? [];
    }
}
