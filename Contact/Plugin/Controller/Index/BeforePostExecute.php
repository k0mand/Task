<?php
/**
 * Smile Plugin BeforePostExecute
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Plugin\Controller\Index;

use Magento\Contact\Controller\Index\Post;
use Smile\Contact\Api\ContactRepositoryInterface;
use Smile\Contact\Model\ContactFactory;
use \Psr\Log\LoggerInterface;

/**
 * Class BeforePostExecute
 *
 * @package Smile\Contact\Plugin\Controller\Index
 */
class BeforePostExecute
{
    /**
     * Contact repository
     *
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * Contact factory
     *
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AddContact constructor
     *
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactFactory             $contactFactory
     * @param LoggerInterface            $logger
     */
    public function __construct(
        ContactFactory $contactFactory,
        ContactRepositoryInterface $contactRepository,
        LoggerInterface $logger
    ) {
        $this->contactFactory = $contactFactory;
        $this->contactRepository = $contactRepository;
        $this->logger = $logger;
    }

    /**
     * Post Before Execute Plugin
     *
     * @param Post $post
     */
    public function beforeExecute(Post $post)
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $post->getRequest();
        $data = $resultRedirect->getPostValue();

        if (!empty($data)) {
            $model = $this->contactFactory->create();
            $model->setData($data);

            try {
                $this->contactRepository->save($model);
            }
            catch (\Exception $e) {
                $this->logger->critical('Error with save contact', ['exception' => $e]);
            }
        }
    }
}
