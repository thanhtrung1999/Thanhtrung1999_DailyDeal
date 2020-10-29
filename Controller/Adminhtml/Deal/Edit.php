<?php
namespace Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

use Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

class Edit extends Deal
{
    /**
     * @return void
     */
    public function execute()
    {
        $dealId = $this->getRequest()->getParam('id');

        $model = $this->_dealFactory->create();

        if ($dealId) {
            $model->load($dealId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getNewsData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('deal_blog', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Thanhtrung1999_DailyDeal::daily_deal');
        $resultPage->getConfig()->getTitle()->prepend(__('Deal'));

        return $resultPage;
    }
}
