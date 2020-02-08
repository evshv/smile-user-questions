<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Delete user question
 */
class Delete extends BaseAction
{
    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $questionId = $this->getRequest()->getParam('id');
        if (!$questionId) {
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $this->questionRepository->deleteById($questionId);

            $this->messageManager->addSuccessMessage(__('Question has been deleted.'));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->messageManager->addExceptionMessage($e, __('Question delete error. See logs for details.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
