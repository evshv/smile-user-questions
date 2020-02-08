<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface as Logger;
use Smile\UserQuestions\Api\QuestionRepositoryInterface;

/**
 * Base action for user question items
 */
abstract class BaseAction extends Action
{
    /**
     * @var bool|PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    protected $logger;

    /**
     * @param Context                     $context
     * @param PageFactory                 $resultPageFactory
     * @param QuestionRepositoryInterface $questionRepository
     * @param Logger                      $logger
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        QuestionRepositoryInterface $questionRepository,
        Logger $logger
    ) {
        parent::__construct($context);
        $this->resultPageFactory  = $resultPageFactory;
        $this->questionRepository = $questionRepository;
        $this->logger             = $logger;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('Smile_UserQuestions::question');
        $resultPage->getConfig()->getTitle()->prepend((__('User Questions')));

        return $resultPage;
    }
}
