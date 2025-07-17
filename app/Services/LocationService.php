<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LocationService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.rajaongkir.com/starter';

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.key');
    }

    /**
     * Get all provinces in Indonesia
     */
    public function getProvinces()
    {
        return Cache::remember('provinces', 3600, function () {
            try {
                $response = Http::withHeaders([
                    'key' => $this->apiKey
                ])->get($this->baseUrl . '/province');

                if ($response->successful()) {
                    return $response->json()['rajaongkir']['results'] ?? [];
                }
            } catch (\Exception $e) {
                // Fallback to static data if API fails
                return $this->getStaticProvinces();
            }

            return $this->getStaticProvinces();
        });
    }

    /**
     * Get cities by province ID
     */
    public function getCities($provinceId = null)
    {
        $cacheKey = $provinceId ? "cities_province_{$provinceId}" : 'cities_all';
        
        return Cache::remember($cacheKey, 3600, function () use ($provinceId) {
            try {
                $url = $this->baseUrl . '/city';
                if ($provinceId) {
                    $url .= "?province={$provinceId}";
                }

                $response = Http::withHeaders([
                    'key' => $this->apiKey
                ])->get($url);

                if ($response->successful()) {
                    return $response->json()['rajaongkir']['results'] ?? [];
                }
            } catch (\Exception $e) {
                // Fallback to static data if API fails
                return $this->getStaticCities($provinceId);
            }

            return $this->getStaticCities($provinceId);
        });
    }

    /**
     * Search cities by keyword
     */
    public function searchCities($keyword)
    {
        $cities = $this->getCities();
        
        return collect($cities)->filter(function ($city) use ($keyword) {
            return stripos($city['city_name'], $keyword) !== false ||
                   stripos($city['type'], $keyword) !== false;
        })->take(10)->values();
    }

    /**
     * Get postal codes for a city
     */
    public function getPostalCodes($cityId)
    {
        return Cache::remember("postal_codes_city_{$cityId}", 3600, function () use ($cityId) {
            try {
                $response = Http::withHeaders([
                    'key' => $this->apiKey
                ])->get($this->baseUrl . "/city?id={$cityId}");

                if ($response->successful()) {
                    $city = $response->json()['rajaongkir']['results'] ?? null;
                    if ($city && isset($city['postal_code'])) {
                        return [$city['postal_code']];
                    }
                }
            } catch (\Exception $e) {
                // Fallback to static data
                return $this->getStaticPostalCodes($cityId);
            }

            return $this->getStaticPostalCodes($cityId);
        });
    }

    /**
     * Static fallback data for provinces
     */
    protected function getStaticProvinces()
    {
        return [
            ['province_id' => '1', 'province' => 'DKI Jakarta'],
            ['province_id' => '2', 'province' => 'Jawa Barat'],
            ['province_id' => '3', 'province' => 'Jawa Tengah'],
            ['province_id' => '4', 'province' => 'Jawa Timur'],
            ['province_id' => '5', 'province' => 'Banten'],
            ['province_id' => '6', 'province' => 'Sumatera Utara'],
            ['province_id' => '7', 'province' => 'Sumatera Barat'],
            ['province_id' => '8', 'province' => 'Sumatera Selatan'],
            ['province_id' => '9', 'province' => 'Lampung'],
            ['province_id' => '10', 'province' => 'Bali'],
            ['province_id' => '11', 'province' => 'Sulawesi Selatan'],
            ['province_id' => '12', 'province' => 'Kalimantan Selatan'],
        ];
    }

    /**
     * Static fallback data for cities
     */
    protected function getStaticCities($provinceId = null)
    {
        $cities = [
            ['city_id' => '1', 'province_id' => '1', 'province' => 'DKI Jakarta', 'type' => 'Kota', 'city_name' => 'Jakarta Pusat', 'postal_code' => '10110'],
            ['city_id' => '2', 'province_id' => '1', 'province' => 'DKI Jakarta', 'type' => 'Kota', 'city_name' => 'Jakarta Utara', 'postal_code' => '14110'],
            ['city_id' => '3', 'province_id' => '1', 'province' => 'DKI Jakarta', 'type' => 'Kota', 'city_name' => 'Jakarta Barat', 'postal_code' => '11110'],
            ['city_id' => '4', 'province_id' => '1', 'province' => 'DKI Jakarta', 'type' => 'Kota', 'city_name' => 'Jakarta Selatan', 'postal_code' => '12110'],
            ['city_id' => '5', 'province_id' => '1', 'province' => 'DKI Jakarta', 'type' => 'Kota', 'city_name' => 'Jakarta Timur', 'postal_code' => '13110'],
            ['city_id' => '6', 'province_id' => '2', 'province' => 'Jawa Barat', 'type' => 'Kota', 'city_name' => 'Bandung', 'postal_code' => '40110'],
            ['city_id' => '7', 'province_id' => '2', 'province' => 'Jawa Barat', 'type' => 'Kota', 'city_name' => 'Bekasi', 'postal_code' => '17110'],
            ['city_id' => '8', 'province_id' => '2', 'province' => 'Jawa Barat', 'type' => 'Kota', 'city_name' => 'Bogor', 'postal_code' => '16110'],
            ['city_id' => '9', 'province_id' => '2', 'province' => 'Jawa Barat', 'type' => 'Kota', 'city_name' => 'Cimahi', 'postal_code' => '40510'],
            ['city_id' => '10', 'province_id' => '2', 'province' => 'Jawa Barat', 'type' => 'Kota', 'city_name' => 'Cirebon', 'postal_code' => '45110'],
            ['city_id' => '11', 'province_id' => '3', 'province' => 'Jawa Tengah', 'type' => 'Kota', 'city_name' => 'Semarang', 'postal_code' => '50110'],
            ['city_id' => '12', 'province_id' => '3', 'province' => 'Jawa Tengah', 'type' => 'Kota', 'city_name' => 'Solo', 'postal_code' => '57110'],
            ['city_id' => '13', 'province_id' => '4', 'province' => 'Jawa Timur', 'type' => 'Kota', 'city_name' => 'Surabaya', 'postal_code' => '60110'],
            ['city_id' => '14', 'province_id' => '4', 'province' => 'Jawa Timur', 'type' => 'Kota', 'city_name' => 'Malang', 'postal_code' => '65110'],
            ['city_id' => '15', 'province_id' => '5', 'province' => 'Banten', 'type' => 'Kota', 'city_name' => 'Serang', 'postal_code' => '42110'],
            ['city_id' => '16', 'province_id' => '5', 'province' => 'Banten', 'type' => 'Kota', 'city_name' => 'Tangerang', 'postal_code' => '15110'],
        ];

        if ($provinceId) {
            return collect($cities)->where('province_id', $provinceId)->values();
        }

        return $cities;
    }

    /**
     * Static fallback data for postal codes
     */
    protected function getStaticPostalCodes($cityId)
    {
        $postalCodes = [
            '1' => ['10110', '10120', '10130', '10140', '10150'],
            '2' => ['14110', '14120', '14130', '14140', '14150'],
            '3' => ['11110', '11120', '11130', '11140', '11150'],
            '4' => ['12110', '12120', '12130', '12140', '12150'],
            '5' => ['13110', '13120', '13130', '13140', '13150'],
            '6' => ['40110', '40120', '40130', '40140', '40150'],
            '7' => ['17110', '17120', '17130', '17140', '17150'],
            '8' => ['16110', '16120', '16130', '16140', '16150'],
            '9' => ['40510', '40520', '40530', '40540', '40550'],
            '10' => ['45110', '45120', '45130', '45140', '45150'],
            '11' => ['50110', '50120', '50130', '50140', '50150'],
            '12' => ['57110', '57120', '57130', '57140', '57150'],
            '13' => ['60110', '60120', '60130', '60140', '60150'],
            '14' => ['65110', '65120', '65130', '65140', '65150'],
            '15' => ['42110', '42120', '42130', '42140', '42150'],
            '16' => ['15110', '15120', '15130', '15140', '15150'],
        ];

        return $postalCodes[$cityId] ?? ['00000'];
    }
} 