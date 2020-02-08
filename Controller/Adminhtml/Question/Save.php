<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Save answer for user question
 */
class Save extends BaseAction
{
    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        $questionId = $this->getRequest()->getParam('question_id');
        if ($questionId && empty($data['answer'])) {
            $this->messageManager->addErrorMessage(__('You can\'t save empty answer.'));
            return $resultRedirect->setPath('*/*/edit', ['id' => $questionId]);
        }

        try {
            $model = $this->questionRepository->getById($questionId);

            $model->setAnswer($data['answer']);
            $model->setStatus($model::UNANSWERED_STATUS);
            $this->questionRepository->save($model);

            $this->messageManager->addSuccessMessage(
                __('Answer has been saved (status will be changed after sending email).')
            );

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
