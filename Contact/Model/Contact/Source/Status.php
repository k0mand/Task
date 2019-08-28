<?php
namespace Smile\Contact\Model\Contact\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smile\Contact\Model\Contact;

/**
 * Class Status
 * @package Smile\Contact\Model\Contact\Source
 */
class Status implements OptionSourceInterface
{
    /**
     * @var Contact
     */

    private $contactStatus;

    /**
     * Status constructor.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contactStatus = $contact;
    }

    /**
     * Get all available options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->contactStatus->getAnswerStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
