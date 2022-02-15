<?php

namespace App\Http\Controllers;

// controlador personalizado usando curl para peticiones
class RequestController
{
    public function __construct($url)
    {
        $this->$url = $url;
        $this->curl = curl_init($url);
    }

    public function post($datos)
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($datos));
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_close($this->curl);
        return curl_exec($this->curl);
    }

    public function get()
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_close($this->curl);
        return curl_exec($this->curl);
    }
}
