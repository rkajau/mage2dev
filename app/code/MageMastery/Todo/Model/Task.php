<?php
/**
 * Task
 *
 * @copyright Copyright © 2021 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */
declare(strict_types=1);
namespace MageMastery\Todo\Model;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;
use Magento\Framework\Model\AbstractModel;

class Task extends AbstractModel implements TaskInterface
{
    const TASK_ID = 'task_id';
    const STATUS = 'status';
    const LABEL = 'label';
    const CUSTOMER_ID = 'customer_id';

    protected function _construct()
    {
        $this->_init(TaskResource::class);
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return (int) $this->getData(self::TASK_ID);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->getData(self::LABEL);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int) $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param int $taskId
     */
    public function setTaskId(int $taskId)
    {
        $this->setData(self::TASK_ID, $taskId);
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->setData(self::LABEL, $label);
    }

    public function setCustomerId(int $customerId)
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }
}
