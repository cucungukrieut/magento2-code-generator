<?php
/**
 * Delete
 *
 * @copyright Copyright (c) ${generator.time.year} ${comments.company.name}
 * @author    ${comments.user.mail}
 */
namespace ${Vendorname}\${Modulename}\Controller\Adminhtml\${Modelname};

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use ${Vendorname}\${Modulename}\Model\${Modelname}Factory;

class Delete extends Action
{
    /** @var ${modelname}Factory $objectFactory */
    protected $objectFactory;

    /**
     * @param Context $context
     * @param ${Modelname}Factory $objectFactory
     */
    public function __construct(
    Context $context,
    ${Modelname}Factory $objectFactory
    ) {
        $this->objectFactory = $objectFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('${Vendorname}_${Modulename}::${modelname}');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('${database_field_id}', null);

        try {
            $objectInstance = $this->objectFactory->create()->load($id);
            if ($objectInstance->getId()) {
                $objectInstance->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the record.'));
            }
            $this->messageManager->addErrorMessage(__('Record does not exist.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        
        return $resultRedirect->setPath('*/*');
    }
}
