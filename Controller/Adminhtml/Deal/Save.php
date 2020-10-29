<?php
namespace Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

use Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

class Save extends Deal
{
    /**
     * @return void
     */
    public function execute()
    {
        $isDeal = $this->getRequest()->getDeal();

        if ($isDeal) {
            $dealModel = $this->_dealFactory->create();
            $dealId = $this->getRequest()->getParam('id');

            if ($dealId) {
                $dealModel->load($dealId);
            }
            $formData = $this->getRequest()->getParam('deal');
            $dealModel->setData($formData);

            try {
                // Save news
                $dealModel->save();

                // Display success message
                $this->messageManager->addSuccess(__('The news has been saved.'));

                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $dealModel->getId(), '_current' => true]);
                    return;
                }

                // Go to grid page
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $dealId]);
        }
    }
}
