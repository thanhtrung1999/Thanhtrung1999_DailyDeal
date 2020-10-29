<?php
namespace Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

use Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

class Delete extends Deal
{
    public function execute()
    {
        $dealId = (int) $this->getRequest()->getParam('id');

        if ($dealId) {
            /** @var $dealModel \Thanhtrung1999\DailyDeal\Model\Deal */
            $dealModel = $this->_dealFactory->create();
            $dealModel->load($dealId);

            // Check this news exists or not
            if (!$dealModel->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
            } else {
                try {
                    // Delete news
                    $dealModel->delete();
                    $this->messageManager->addSuccess(__('The news has been deleted.'));

                    // Redirect to grid page
                    $this->_redirect('*/*/');
                    return;
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    $this->_redirect('*/*/edit', ['id' => $dealModel->getId()]);
                }
            }
        }
    }
}
