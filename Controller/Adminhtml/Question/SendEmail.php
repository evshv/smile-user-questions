<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Controller\Adminhtml\Question;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface as Logger;
use Smile\UserQuestions\Api\QuestionRepositoryInterface;
use Smile\UserQuestions\Model\Mail;

/**
 * Send email with answer to the user
 */
class SendEmail extends BaseAction
{
    /**
     * @var Mail
     */
    protected $mail;

    /**
     * @param Context                     $context
     * @param PageFactory                 $resultPageFactory
     * @param QuestionRepositoryInterface $questionRepository
     * @param Mail                        $mail
     * @param Logger                      $logger
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        QuestionRepositoryInterface $questionRepository,
        Logger $logger,
        Mail $mail
    ) {
        parent::__construct($context, $resultPageFactory, $questionRepository, $logger);
        $this->mail = $mail;
    }

    /**
     * Send email action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $questionId = $this->getRequest()->getParam('id');
        if (!$questionId) {
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $model = $this->questionRepository->getById($questionId);

            if (!$model->getAnswer()) {
                $this->messageManager->addErrorMessage(__('You can\'t send email without the answer.'));

                return $resultRedirect->setPath('*/*/edit', ['id' => $questionId]);
            }

            $this->mail->send($model->getEmail(), [
                'name'    => $model->getName(),
                'email'   => $model->getEmail(),
                'comment' => $model->getComment(),
                'answer'  => $model->getAnswer(),
            ]);

            $model->setStatus($model::ANSWERED_STATUS);
            $this->questionRepository->save($model);

            $this->messageManager->addSuccessMessage(__('Email has been sent.'));

            return $resultRedirect->setPath('*/*/edit', ['id' => $questionId]);
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, __('Updating question error. See logs for details.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
