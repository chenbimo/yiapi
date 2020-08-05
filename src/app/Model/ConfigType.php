<?php

namespace App\Model;

use App\Model\BaseModel;

class ConfigType extends BaseModel {
    protected function getTableName($id) {
        return '`config_type`';
    }
}
