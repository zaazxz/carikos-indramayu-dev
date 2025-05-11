<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    // Variable
    private $setting = [
        'coordinat' => '-6.333933182070731, 108.33948946880335',
        'zoom' => '12'
    ];

    public function getSetting()
    {
        return $this->setting;
    }

}
