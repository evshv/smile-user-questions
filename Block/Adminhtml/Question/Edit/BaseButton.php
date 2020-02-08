<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Block\Adminhtml\Question\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;

/**
 * Base button for question form actions
 */
abstract class BaseButton
{
    /**
     * Context
     *
     * @var Context
     */
    protected $context;

    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context    = $context;
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * Generate url by route and parameters
     *
     * @param  string $route
     * @param  array  $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
