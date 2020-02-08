<?php

namespace Smile\UserQuestions\Model;

/**
 * Email for sending answer to user question
 */
interface MailInterface
{
    /**
     * Send email with answer to the user
     *
     * @param  string $recipient
     * @param  array  $variables
     * @return void
     */
    public function send(string $recipient, array $variables): void;
}
