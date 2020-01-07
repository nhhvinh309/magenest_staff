<?php
namespace Magenest\Staff\Model;
class MagenestStaff extends
    \Magento\Framework\Model\AbstractModel {
    public function _construct() {
        $this->_init('Magenest\Staff\Model\ResourceModel\MagenestStaff');
    }
}