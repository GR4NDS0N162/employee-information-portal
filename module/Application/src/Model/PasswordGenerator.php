<?php

namespace Application\Model;

use Exception;

class PasswordGenerator
{
    /**
     * @param int $length
     *
     * @return string
     * @throws Exception
     */
    public static function generate($length = 8)
    {
        $chars = [
            [
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
                'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
            ],
            [
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
                'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
            ],
            ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            [
                '!', '"', '#', '$', '%', '&', '\'', '\\', ')', '*',
                '+', ',', '-', '.', '/', ':', ';', '<', '=', '>',
                '?', '@', '[', ']', '^', '_', '`', '{', '|', '}', '~'
            ]
        ];

        $password = '';

        foreach ($chars as $charset) {
            $password .= $charset[random_int(0, count($charset) - 1)];
        }

        for ($i = 0; $i < $length - count($chars); $i++) {
            $charset = $chars[random_int(0, count($chars) - 1)];
            $password .= $charset[random_int(0, count($charset) - 1)];
        }

        return str_shuffle($password);
    }
}