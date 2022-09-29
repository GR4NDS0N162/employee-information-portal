<?php

namespace Application\Model;

class PhotoUrlGenerator
{
    public static function generate()
    {
        return 'https://picsum.photos/' . random_int(100, 999);
    }
}