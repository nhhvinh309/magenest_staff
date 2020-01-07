<?php
namespace Magenest\Staff\Model\ResourceModel\MagenestStaff;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    public function _construct() {
        $this->_init('Magenest\Staff\Model\MagenestStaff',
            'Magenest\Staff\Model\ResourceModel\MagenestStaff');
    }
}