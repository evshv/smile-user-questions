<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Smile\UserQuestions\Model\ResourceModel\Question\CollectionFactory;

/**
 * Action for mass deleting
 */
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute mass delete action
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection   = $this->collectionFactory->create();
        $collection   = $this->filter->getCollection($collection);
        $deletedCount = $collection->getSize();
        $collection->walk('delete');

        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $deletedCount)
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
