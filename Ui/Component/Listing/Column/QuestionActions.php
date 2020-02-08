<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Actions for "Actions" columns in questions list (grid)
 */
class QuestionActions extends Column
{
    /**
     * Url path for edit
     */
    const URL_PATH_EDIT = 'smile_userquestions/question/edit';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            if (!isset($item['question_id'])) {
                continue;
            }

            $item['status'] = ($item['status'] ? __('Yes') : __('No'));

            $item[$this->getData('name')] = [
                'edit' => [
                    'href' => $this->urlBuilder->getUrl(
                        static::URL_PATH_EDIT,
                        [
                            'id' => $item['question_id']
                        ]
                    ),
                    'label' => __('Edit'),
                    '__disableTmpl' => true
                ],
            ];
        }

        return $dataSource;
    }
}
