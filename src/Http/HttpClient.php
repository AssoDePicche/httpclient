<?php

declare(strict_types=1);

namespace Http;

final class HttpClient
{
    public bool $ssl = false;

    public \CurlHandle $curl;

    public function __construct(public readonly string $url)
    {
        $this->curl = curl_init();

        curl_setopt_array($this->curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'] ?? 'httpclient/v0.1'
        ]);
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

    public function request(string $request = 'GET', array $header = [], array $data = []): string|bool
    {
        curl_setopt_array($this->curl, [
            CURLOPT_CUSTOMREQUEST => $request,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $data
        ]);

        if (false === $this->ssl) {
            curl_setopt_array($this->curl, [
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
        }

        $response = curl_exec($this->curl);

        if (false !== $response) {
            return $response;
        }

        throw new \Exception(curl_error($this->curl), curl_errno($this->curl));
    }
}
