<?php

declare(strict_types=1);
/**
 * Undocumented class
 */
class Site extends Api {
    public static function Index() {
        return 'Site.Index';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function Sel() {
        $stat = DB::model()->query('SELECT * FROM `user`');
        $res = $stat->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($res);
    }
}
