<?php

namespace App\Common;

use PhalApi\Exception\BadRequestException;
use PhalApi\Filter;

/**
 * NoneFilter 无作为的拦截器
 *
 * @license     http://www.phalapi.net/license GPL 协议
 *
 * @see        http://www.phalapi.net/
 *
 * @author      dogstar <chanzonghuang@gmail.com> 2015-10-23
 */
class MyFilter implements Filter {
    public function check() {
        if (!$_SESSION['user_id']) {
            throw new BadRequestException('尚未登录', 1);
        }
    }
}
