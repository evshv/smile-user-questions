<?php
/**
 * Model has many different functions such as manage data, install or upgrade module.
 * Model file contain overall database logic, it do not execute sql queries. The resource model will do that.
 */
declare(strict_types=1);

namespace Smile\UserQuestions\Model;

use Magento\Framework\Model\AbstractModel;
use Smile\UserQuestions\Api\Data\QuestionInterface;
use Smile\UserQuestions\Model\ResourceModel\Question as QuestionResource;

/**
 * Question model
 */
class Question extends AbstractModel implements QuestionInterface
{
    /**
     * @return array|mixed|string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @return array|mixed|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @return array|mixed|null
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @param string $answer
     * @return Question|void
     */
    public function setAnswer(string $answer)
    {
        $this->setData(self::ANSWER, $answer);
    }

    /**
     * @return array|mixed|null
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param int $status
     * @return Question|void
     */
    public function setStatus(int $status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @return array|mixed|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(QuestionResource::class);
    }
}
