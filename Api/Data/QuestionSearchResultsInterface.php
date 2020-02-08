<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Question search results interface
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions list
     *
     * @return QuestionInterface[]
     */
    public function getItems();

    /**
     * Set questions list
     *
     * @param QuestionInterface[] $items
     *
     * @return QuestionSearchResultsInterface
     */
    public function setItems(array $items);
}
