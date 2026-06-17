<?php

namespace App\Controllers;

class RajaOngkirController extends BaseController
{
    public function province()
    {
        return $this->response->setJSON([
            [
                'id' => 1,
                'name' => 'Riau'
            ],
            [
                'id' => 2,
                'name' => 'Sumatera Barat'
            ],
            [
                'id' => 3,
                'name' => 'DKI Jakarta'
            ]
        ]);
    }

    public function city($provinceId)
    {
        $cities = [

            1 => [
                [
                    'id' => 101,
                    'name' => 'Pekanbaru'
                ],
                [
                    'id' => 102,
                    'name' => 'Dumai'
                ]
            ],

            2 => [
                [
                    'id' => 201,
                    'name' => 'Padang'
                ],
                [
                    'id' => 202,
                    'name' => 'Bukittinggi'
                ]
            ],

            3 => [
                [
                    'id' => 301,
                    'name' => 'Jakarta Selatan'
                ],
                [
                    'id' => 302,
                    'name' => 'Jakarta Barat'
                ]
            ]
        ];

        return $this->response->setJSON(
            $cities[$provinceId] ?? []
        );
    }
}