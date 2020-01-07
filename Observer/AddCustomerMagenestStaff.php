<?php

namespace Magenest\Staff\Observer;

use Magento\Framework\Event\ObserverInterface;

class AddCustomerMagenestStaff implements ObserverInterface
{
    protected $staffFactory;
    protected $_customerRepositoryInterface;
    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magenest\Staff\Model\MagenestStaffFactory $staffFactory
    )
    {
        $this->staffFactory = $staffFactory;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $customer = $observer->getEvent()->getCustomer();
        $customAtrr = $customer->getCustomAttributes();
        $staffType = $customAtrr["staff_type"]->getvalue();
        $staff = $this->staffFactory->create();
        $staff->setstatus(2);
        $staff->setnick_name($customer->getFirstname() . " " . $customer->getLastname());
        $staff->setcustomer_id($customer->getId());
        $staff->settype($staffType);
        $staff->save();
    }
}
