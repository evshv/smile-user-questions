<?php
declare(strict_types=1);

namespace Smile\UserQuestions\Model\Question;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Smile\UserQuestions\Model\ResourceModel\Question\CollectionFactory;

/**
 * Data provider for question form
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $questionCollectionFactory->create();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $this->loadedData = [];

        foreach ($this->collection->getItems() as $question) {
            $data = $question->getData();

            $data['created_at'] = (new \DateTime($data['created_at']))->format(DATE_RFC2822);
            $data['updated_at'] = (new \DateTime($data['updated_at']))->format(DATE_RFC2822);

            $this->loadedData[$question->getId()] = $data;
        }

        return $this->loadedData;
    }
}
