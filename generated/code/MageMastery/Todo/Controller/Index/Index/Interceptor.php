<?php
namespace MageMastery\Todo\Controller\Index\Index;

/**
 * Interceptor class for @see \MageMastery\Todo\Controller\Index\Index
 */
class Interceptor extends \MageMastery\Todo\Controller\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \MageMastery\Todo\Model\TaskFactory $taskFactory, \MageMastery\Todo\Model\ResourceModel\Task $taskResource, \MageMastery\Todo\Service\TaskRepository $taskRepository)
    {
        $this->___init();
        parent::__construct($context, $taskFactory, $taskResource, $taskRepository);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
