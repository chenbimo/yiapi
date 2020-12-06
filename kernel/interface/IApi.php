<?php

declare(strict_types=1);
interface IApi {
    /**
     * 通用插入函数
     *
     * @return void
     */
    public static function Ins();

    /**
     * 通用删除函数
     *
     * @return void
     */
    public static function Del();

    /**
     * 通用修改函数
     *
     * @return void
     */
    public static function Upd();

    /**
     * 通用查询函数
     *
     * @return void
     */
    public static function Sel();
}
