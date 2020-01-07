<?php

namespace Magenest\Staff\Block\StaffRegistry;

use Magento\Framework\View\Element\Template;

class StaffRegistry extends \Magento\Framework\View\Element\Template
{
    protected $staffFactory;
    protected $sessionFactory;
    protected $customerRepository;
    protected $collectionFactory;

    public function __construct(Template\Context $context, array $data = [],
                                \Magenest\Staff\Model\MagenestStaffFactory $staffFactory,
                                \Magenest\Staff\Model\ResourceModel\MagenestStaff\CollectionFactory $collectionFactory,
                                \Magento\Customer\Model\SessionFactory $sessionFactory,
                                \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository)
    {
        $this->staffFactory = $staffFactory;
        $this->sessionFactory = $sessionFactory;
        $this->customerRepository = $customerRepository;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }
    public function getStaffData(){
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect("id")->addFieldToSelect("customer_id");
        return $collection->getData();
    }
    public function staffRegistry($staffType, $nickName)
    {
        $sessionModel = $this->sessionFactory->create();
        $staff = $this->staffFactory->create();
        $customerId = $sessionModel->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        // set staff type custom Attribute
        $customer->setCustomAttribute('staff_type',$staffType);
        $this->customerRepository->save($customer);
        $staffData = $this->getStaffData();
        foreach ($staffData as $data){
            if ($data["customer_id"] == $customerId){
                $staff->setid($data["id"]);
            }
        }
        $staff->setstatus(2);
        $staff->setnick_name($nickName);
        $staff->setcustomer_id($customerId);
        $staff->settype($staffType);
        $staff->save();
    }
}
