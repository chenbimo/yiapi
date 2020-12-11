<?php


class UserModel extends Model implements I_Model {
    // 当前表名
    public static string $tableName = 'user';

    // 字段集
    public static array $fields = ['username', 'password'];
}
