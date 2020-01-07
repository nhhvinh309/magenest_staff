<?php
namespace Magenest\Staff\Plugin;

class ProductListPlugin {

    protected $sessionFactory;
    public function __construct(\Magento\Customer\Model\SessionFactory $sessionFactory)
    {
        $this->sessionFactory = $sessionFactory;
    }

    public function afterGetProductPrice($subject, $result, $product)
    {
        $sessionModel = $this->sessionFactory->create();
        $customerId = $sessionModel->getCustomer()->getId();
        $customerData = $sessionModel->getCustomer()->getData();
        if(isset($customerData["staff_type"]))
        {
            if($customerData["staff_type"] == "1")
                return $result."lv1";
            else if($customerData["staff_type"] == "2")
                return $result."lv2";
        }
        return $result ;

    }

}