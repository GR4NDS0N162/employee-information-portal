<?php

namespace Application\Model\Options;

class YesNoOptions
{
    /**
     * @return array
     */
    public static function getActiveOptions()
    {
        return [
            null => 'Not specified',
            1    => [
                'value'    => '1',
                'label'    => 'Yes',
                'selected' => 'selected',
            ],
            2    => 'No',
        ];
    }

    /**
     * @return array
     */
    public static function getAdminOptions()
    {
        return [
            null => [
                'label'    => 'Not specified',
                'selected' => 'selected',
            ],
            1    => 'Yes',
            2    => 'No',
        ];
    }
}