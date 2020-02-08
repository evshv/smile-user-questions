<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\UserQuestions\Api\QuestionRepositoryInterface;
use Smile\UserQuestions\Api\Data\QuestionInterface;
use Smile\UserQuestions\Model\ResourceModel\Question as QuestionResource;

/**
 * Implementation of question repository interface
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var QuestionResource
     */
    private $questionResource;

    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * @param QuestionResource $questionResource
     * @param QuestionFactory  $questionFactory
     */
    public function __construct(
        QuestionResource $questionResource,
        QuestionFactory $questionFactory
    ) {
        $this->questionResource = $questionResource;
        $this->questionFactory  = $questionFactory;
    }

    /**
     * @param  QuestionInterface|Question $question
     * @return QuestionInterface
     * @throws AlreadyExistsException
     */
    public function save($question)
    {
        $this->questionResource->save($question);

        return $question;
    }

    /**
     * @param  int $questionId
     * @return QuestionInterface|ResourceModel\Question\Collection|Question
     * @throws NoSuchEntityException
     */
    public function getById($questionId)
    {
        $question = $this->questionFactory->create();

        $this->questionResource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $questionId));
        }

        return $question;
    }

    /**
     * @param  int $questionId
     * @return ResourceModel\Question
     * @throws \Exception
     */
    public function deleteById($questionId)
    {
        return $this->questionResource->delete($this->getById($questionId));
    }
}
