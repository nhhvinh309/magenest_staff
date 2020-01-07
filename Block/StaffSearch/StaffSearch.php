<?php

namespace Magenest\Staff\Block\StaffSearch;

use Magenest\Staff\Model\ResourceModel\MagenestStaff\CollectionFactory;

class StaffSearch extends \Magento\Framework\View\Element\Template {

    protected $_staffFactory;
    protected $_resourceConnection;
    protected $_collectionFactory;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenest\Staff\Model\MagenestStaffFactory $magenestStaffFactory,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory
    ) {
        $this->_storeManager = $storeManager;
        $this->_staffFactory = $magenestStaffFactory;
        $this->_resourceConnection = $resourceConnection;
        $this->_collectionFactory = $collectionFactory;

        parent::__construct($context);
    }
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getHeightData()
    {
        return $this->getHeight();
    }

    public function searchStaff($searchString){
        $collection = $this->_collectionFactory->create();
        $data = $collection->getData();
        $string = "";
        foreach ($data as $item){
            if(!empty($searchString) && strpos($item["nick_name"], $searchString) !== false)
            {
                $string .= '<p>' .$item["nick_name"]. ' </p>';
            }
        }
        return $string;
    }
}
