<?php

declare(strict_types=1);
interface I_Api {
    /**
     * 通用插入接口
     *
     * @return void
     */
    public  function Ins();

    /**
     * 通用删除接口
     *
     * @return void
     */
    public  function Del();

    /**
     * 通用修改接口
     *
     * @return void
     */
    public  function Upd();

    /**
     * 通用查询接口
     *
     * @return void
     */
    public  function Sel();

    /**
     * 通用详情接口
     *
     * @return void
     */
    public  function Detail();
}
