<?php

namespace Magenest\Staff\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;

use Magento\Framework\DB\Ddl\Table;

class StaffType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $optionFactory;

    public function getAllOptions()

    {
        $this->_options = [['label' => '', 'value' => ''],

            ['label' => 'lv1', 'value' => '1'],

            ['label' => 'lv2', 'value' => '2']

        ];
        return $this->_options;
    }
}