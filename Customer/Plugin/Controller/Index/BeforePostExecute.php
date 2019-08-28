<?php
/**
 * Task Plugin BeforePostExecute
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Plugin\Controller\Index;

use Magento\Contact\Controller\Index\Post;
use Task\Customer\Api\RequestRepositoryInterface;
use Task\Customer\Model\RequestFactory;
use \Psr\Log\LoggerInterface;

/**
 * Class BeforePostExecute
 *
 * @package Task\Customer\Plugin\Controller\Index
 */
class BeforePostExecute
{
    /**
     * Request repository
     *
     * @var RequestRepository
     */
    private $requestRepository;

    /**
     * Request factory
     *
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AddRequest constructor
     *
     * @param RequestRepositoryInterface $requestRepository
     * @param RequestFactory             $requestFactory
     * @param LoggerInterface            $logger
     */
    public function __construct(
        RequestFactory $requestFactory,
        RequestRepositoryInterface $requestRepository,
        LoggerInterface $logger
    ) {
        $this->requestFactory = $requestFactory;
        $this->requestRepository = $requestRepository;
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
            $model = $this->requestFactory->create();
            $model->setData($data);

            try {
                $this->requestRepository->save($model);
            }
            catch (\Exception $e) {
                $this->logger->critical('Error with save request', ['exception' => $e]);
            }
        }
    }
}
