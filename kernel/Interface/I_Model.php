<?php

declare(strict_types=1);
interface I_Model {
    /**
     * 通用插入模型
     *
     * @return void
     */
    public static function Ins(string $tableName, array $params);

    /**
     * 通用删除模型
     *
     * @return void
     */
    public static function Del(string $tableName, array $params);

    /**
     * 通用修改模型
     *
     * @return void
     */
    public static function Upd(string $tableName, array $params);

    /**
     * 通用查询模型
     *
     * @return void
     */
    public static function Sel(string $tableName, array $params);

    /**
     * 通用详情模型
     *
     * @return void
     */
    public static function Detail();
}
