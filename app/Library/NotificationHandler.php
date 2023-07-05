<?php

namespace App\Library;

class NotificationHandler
{
    public function __construct()
    {
    }

    public static function send(array $payload)
    {
        $payload = [
            'postmark_server_key' => env('MAIL_KEY'),
            'from' => $payload['from'],
            'recipients' => $payload['recipients'],
            'templateId' => $payload['templateId'],
            'templateModelArray' => $payload['templateModelArray'],
            'attachmentsArray' => $payload['attachmentsArray'] ?? null,
            'messageStream' => $payload['messageStream'] ?? null,
        ];

        // call notificaion api
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => app()->environment('local') ? env('MAIL_SERVICE_URI_TEST') : env('MAIL_SERVICE_URI'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
