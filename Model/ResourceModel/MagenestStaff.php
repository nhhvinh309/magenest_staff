<?php
namespace Magenest\Staff\Model\ResourceModel;
class MagenestStaff extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct() {
        $this->_init('magenest_staff','id');
    }
}