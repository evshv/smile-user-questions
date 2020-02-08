<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete button
 */
class DeleteButton extends BaseButton implements ButtonProviderInterface
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
                'label'      => __('Delete'),
                'class'      => 'delete',
                'on_click'   => 'deleteConfirm(\'' . __('Are you sure to delete this question?') . '\', \''
                    . $this->getDeleteUrl($modelId) . '\')',
            ];
        }

        return $data;
    }

    /**
     * Get URL for delete button
     *
     * @param  int    $modelId
     * @return string
     */
    public function getDeleteUrl(int $modelId): string
    {
        return $this->getUrl('*/*/delete', ['id' => $modelId]);
    }
}
