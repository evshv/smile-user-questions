<?php

namespace Smile\UserQuestions\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Smile\UserQuestions\Api\Data\QuestionInterface;

/**
 * Question repository interface
 */
interface QuestionRepositoryInterface
{
    /**
     * Create question service
     *
     * @param  QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save($question);

    /**
     * Get info about question by question id
     *
     * @param  int $questionQuestionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById($questionQuestionId);

    /**
     * Delete question by id
     *
     * @param  int $questionId
     * @return bool
     * @throws InputException
     * @throws StateException
     * @throws NoSuchEntityException
     */
    public function deleteById($questionId);
}
