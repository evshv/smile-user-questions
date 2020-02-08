<?php

namespace Smile\UserQuestions\Api\Data;

/**
 * Question interface
 */
interface QuestionInterface
{
    /**
     * Constants
     */
    const QUESTION_ID       = 'question_id';
    const NAME              = 'name';
    const EMAIL             = 'email';
    const TELEPHONE         = 'telephone';
    const COMMENT           = 'comment';
    const ANSWER            = 'answer';
    const STATUS            = 'status';
    const CREATED_AT        = 'created_at';
    const UPDATED_AT        = 'updated_at';
    const ANSWERED_STATUS   = 1;
    const UNANSWERED_STATUS = 0;

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @return mixed
     */
    public function getComment();

    /**
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer);

    /**
     * @return mixed
     */
    public function getAnswer();

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status);

    /**
     * @return mixed
     */
    public function getStatus();
}
