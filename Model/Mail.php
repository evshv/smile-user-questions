<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Model;

use Magento\Framework\App\Area;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class for preparing and sending emails with answers
 */
class Mail implements MailInterface
{
    const EMAIL_TEMPLATE_IDENTIFIER = 'answer_email_template';

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param TransportBuilder      $transportBuilder
     * @param StateInterface        $inlineTranslation
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        StoreManagerInterface $storeManager
    ) {
        $this->transportBuilder  = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager      = $storeManager;
    }

    /**
     * Send email method
     *
     * @param  string $recipient
     * @param  array  $variables
     * @return void
     * @throws LocalizedException
     * @throws MailException
     */
    public function send(string $recipient, array $variables): void
    {
        $this->inlineTranslation->suspend();

        $transport = $this->transportBuilder
            ->setTemplateIdentifier(self::EMAIL_TEMPLATE_IDENTIFIER)
            ->setTemplateOptions(
                [
                    'area'  => Area::AREA_FRONTEND,
                    'store' => $this->storeManager->getStore()->getId()
                ]
            )
            ->setTemplateVars($variables)
            ->addTo($recipient)
            ->getTransport();

        $transport->sendMessage();

        $this->inlineTranslation->resume();
    }
}
