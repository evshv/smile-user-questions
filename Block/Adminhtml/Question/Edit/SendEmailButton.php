<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Button for sending email with answer to the user
 */
class SendEmailButton extends BaseButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $data    = [];
        $modelId = (int)$this->context->getRequest()->getParam('id');
        if ($modelId) {
            $data = [
                'label'      => __('Send email'),
                'class'      => 'primary',
                'on_click'   => 'deleteConfirm(\'' . __('Are you sure to send this answer to the user?') . '\', \''
                    . $this->getSendEmailUrl($modelId) . '\')',
            ];
        }

        return $data;
    }

    /**
     * Get URL for sending email button
     *
     * @param  int    $modelId
     * @return string
     */
    public function getSendEmailUrl(int $modelId): string
    {
        return $this->getUrl('*/*/sendemail', ['id' => $modelId]);
    }
}
