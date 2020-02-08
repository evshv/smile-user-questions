<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Resource model for question
 */
class Question extends AbstractDb
{
    /**
     * Initialize connection and define main table
     */
    protected function _construct()
    {
        $this->_init('smile_user_questions', 'question_id');
    }
}
