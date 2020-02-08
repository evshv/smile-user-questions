<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Plugin;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface as Logger;
use Smile\UserQuestions\Model\Question as QuestionModel;

/**
 * Plugin for saving user questions to DB after sending "Contact Us" email
 */
class SaveQuestion
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @param RequestInterface      $request
     * @param StoreManagerInterface $storeManager
     * @param Logger                $logger
     * @param Context               $context
     */
    public function __construct(
        RequestInterface $request,
        StoreManagerInterface $storeManager,
        Logger $logger,
        Context $context
    ) {
        $this->request               = $request;
        $this->storeManager          = $storeManager;
        $this->logger                = $logger;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
    }

    /**
     * @return Redirect
     */
    public function afterExecute(): Redirect
    {
        try {
            $question = ObjectManager::getInstance()->create(QuestionModel::class);
            $question->setData($this->request->getParams());
            $question->save();
        } catch (\Exception $e) {
            $this->logger->error($e);
        }

        return $this->resultRedirectFactory->create()->setPath('contact');
    }
}
