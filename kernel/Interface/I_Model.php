<?php

interface I_Model {
    /**
     * 通用插入模型
     *
     * @return void
     */
    public function Ins(array $params);

    /**
     * 通用删除模型
     *
     * @return void
     */
    public function Del(array $params);

    /**
     * 通用修改模型
     *
     * @return void
     */
    public function Upd(array $params);

    /**
     * 通用查询模型
     *
     * @return void
     */
    public function Sel(array $params);

    /**
     * 通用详情模型
     *
     * @return void
     */
    public function Detail();
}
