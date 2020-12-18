<?php

namespace U89Man\TBot;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Exceptions\ValueException;

class Utils
{
    /**
     * Создает массив сущностей.
     *
     * @param string $class
     * @param array|string $data
     *
     * @return array
     */
    public static function makeArray($class, $data)
    {
        $arr = array();

        foreach (self::wrap($data) as $d) {
            $arr[] = new $class($d);
        }

        return $arr;
    }

    /**
     * Конвертируе значение в массив, если оно еще не является массивом.
     *
     * @param mixed $value
     *
     * @return array
     */
    public static function wrap($value)
    {
        return is_array($value) ? $value : array($value);
    }

    /**
     * Конвертирует значение в Json-строку.
     *
     * @param mixed $value
     * @param bool $required
     *
     * @return string
     */
    public static function toJson($value, $required = true)
    {
        if ($required && $value === null) {
            throw new ValueException('Отсутствует значение для конвертирования в json-строку');
        }

        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = self::toJson($v, false);
            }

            $value = '['.implode(',', $value).']';
        } else {
            $value = $value instanceof Entity ? $value->toJson() : json_encode($value);
        }

        return $value;
    }

    /**
     * Конвертирует значение в Json-строку, если значение не null.
     *
     * @param mixed $value
     *
     * @return string|null
     */
    public static function toJsonOrNull($value)
    {
        return $value !== null ? self::toJson($value, false) : null;
    }

    /**
     * Проверяет числовое значение.
     *
     * @param int|float|null $num
     * @param int|float|null $min
     * @param int|float|null $max
     * @param bool|null $required
     * @param int|float|null $default
     *
     * @return int|float|null
     */
    public static function checkNum($num, $min = null, $max = null, $required = null, $default = null)
    {
        if ($num === null) {
            if ($required) {
                throw new ValueException('Значение является обязательным');
            }

            return $default;
        }

        if (! is_numeric($num)) {
            throw new ValueException('Значение не является числом');
        }

        if ($min !== null && $num < $min) {
            throw new ValueException('Значение ниже допустимого');
        }

        if ($max !== null && $num > $max) {
            throw new ValueException('Значение превышает допустимое');
        }

        return $num;
    }

    /**
     * Проверяет строковое значение.
     *
     * @param string|null $str
     * @param int|null $min
     * @param int|null $max
     * @param bool|null $required
     * @param string|null $default
     *
     * @return string|null
     */
    public static function checkStr($str, $min = null, $max = null, $required = null, $default = null)
    {
        if ($str === null) {
            if ($required) {
                throw new ValueException('Значение является обязательным');
            }

            return $default;
        }

        if (! is_string($str)) {
            throw new ValueException('Значение не является строкой');
        }

        $len = mb_strlen($str);

        if ($min !== null && $len < $min) {
            throw new ValueException("Значение слишком короткое");
        }

        if ($max !== null && $len > $max) {
            throw new ValueException('Значение превышает допустимую длинну');
        }

        return $str;
    }
}
