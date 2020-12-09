<?php

declare(strict_types=1);

class M_Site extends Model implements I_Model {
    public static function SetTableName() {
        return 'site';
    }
}
