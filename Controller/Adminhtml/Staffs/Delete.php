<?php
namespace Magenest\Staff\Controller\Adminhtml\Staffs;

use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;
    public function __construct(
        Action\Context $context,
        \Magenest\Staff\Model\MagenestStaff $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Staff::staff_delete');
    }
    public function execute()
    {
        $requestData = $this->getRequest()->getParams();
        $ids = $requestData["selected"];
        foreach ($ids as $id)
        {
            $this->_model->setId($ids)->delete();
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}