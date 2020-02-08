<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smile\UserQuestions\Model\Question as QuestionModel;
use Smile\UserQuestions\Model\ResourceModel\Question as QuestionResource;

/**
 * Collection allows us to filter and fetch a collection table data.
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuestionModel::class, QuestionResource::class);
    }
}
