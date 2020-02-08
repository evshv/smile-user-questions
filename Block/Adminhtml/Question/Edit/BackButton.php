<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Back button
 */
class BackButton extends BaseButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label'    => __('Back'),
            'class'    => 'back',
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl())
        ];
    }

    /**
     * Get URL for back button
     *
     * @return string
     */
    public function getBackUrl(): string
    {
        return $this->getUrl('*/*/');
    }
}
