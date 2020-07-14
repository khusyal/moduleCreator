<?php

namespace LR\Course\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface CourseLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \LR\Course\Model\Course
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
