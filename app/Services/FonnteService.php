<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected string $apiKey;
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fonnte.api_key');
        $this->apiUrl = config('services.fonnte.api_url'); // Harus: 'https://api.fonnte.com/send'
    }

    /**
     * Kirim pesan WhatsApp via Fonnte (dengan timeout 10 detik)
     */
    public function send(string $target, string $message, array $options = []): array
    {
        $payload = array_merge([
            'target' => $this->normalizePhone($target),
            'message' => $message,
        ], $options);

        try {
            // 🔥 Perbaikan utama: timeout 10 detik, jangan disable SSL!
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
            ])
                ->timeout(10)          // ⏱️ Maksimal 10 detik
                ->connectTimeout(5)    // ⏱️ Koneksi maks 5 detik
                ->post($this->apiUrl, $payload);

            $result = $response->json();

            Log::info('Fonnte API Response', [
                'target' => $target,
                'status' => $response->status(),
                'response' => $result,
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Fonnte API Error', [
                'target' => $target,
                'message_preview' => substr($message, 0, 50) . '...',
                'error' => $e->getMessage(),
            ]);

            // Jangan kembalikan error detail ke user
            return ['error' => 'failed'];
        }
    }

    /**
     * Normalisasi nomor: 0812 → 62812
     */
    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);
        if (substr($phone, 0, 2) === '08') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 1) !== '6') {
            $phone = '62' . $phone;
        }
        return $phone;
    }
}