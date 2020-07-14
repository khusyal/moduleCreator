<?php

namespace LR\Course\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class CourseLoader implements CourseLoaderInterface
{
    /**
     * @var \LR\Course\Model\CourseFactory
     */
    protected $courseFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \LR\Course\Model\CourseFactory $courseFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \LR\Course\Model\CourseFactory $courseFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->courseFactory = $courseFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $course = $this->courseFactory->create()->load($id);
        $this->registry->register('current_course', $course);
        return true;
    }
}
