<?php

namespace App\Model;

use App\Model\BaseModel;

class Partner extends BaseModel {
    protected function getTableName($id) {
        return '`partner`';
    }
}
