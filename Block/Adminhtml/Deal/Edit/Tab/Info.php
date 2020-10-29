<?php
namespace Thanhtrung1999\DailyDeal\Block\Adminhtml\Deal\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Thanhtrung1999\DailyDeal\Model\System\Config\Status;

class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Thanhtrung1999\DailyDeal\Model\System\Config\Status
     */
    protected $_status;
    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $status
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $status,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
        /** @var $model \Thanhtrung1999\DailyDeal\Model\DealFactory */
        $model = $this->_coreRegistry->registry('deal_blog');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('deal_');
        $form->setFieldNameSuffix('deal');
        // new filed

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'deal-status',
            'select',
            [
                'name'      => 'Deal status',
                'label'     => __('Deal status'),
                'options'   => $this->_status->toOptionArray()
            ]
        );
        $fieldset->addField(
            'deal-price',
            'numeric',
            [
                'name'      => 'deal_price',
                'label'     => __('Deal price'),
                'title' => __('Deal price'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'deal-quantity',
            'numeric',
            [
                'name'      => 'deal_quantity',
                'label'     => __('Deal quantity'),
                'title' => __('Deal quantity'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'deal-start',
            'datetime',
            array(
                'name'      => 'deal_start',
                'label'     => __('Deal start'),
                'title' => __('Deal start'),
                'required' => true
            )
        );
        $fieldset->addField(
            'deal-end',
            'datetime',
            array(
                'name'      => 'deal_end',
                'label'     => __('Deal end'),
                'title' => __('Deal end'),
                'required' => true
            )
        );
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Deal Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Deal Info');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
