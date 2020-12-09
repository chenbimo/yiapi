<?php

declare(strict_types=1);
interface I_Model {
    /**
     * 通用初始化模型
     *
     * @return void
     */
    public static function Init();

    public static function SetTableName();

    /**
     * 通用插入模型
     *
     * @return void
     */
    public function Ins();

    /**
     * 通用删除模型
     *
     * @return void
     */
    public function Del();

    /**
     * 通用修改模型
     *
     * @return void
     */
    public function Upd();

    /**
     * 通用查询模型
     *
     * @return void
     */
    public function Sel(): array;

    /**
     * 通用详情模型
     *
     * @return void
     */
    public function Detail();
}
