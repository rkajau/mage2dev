<?php
/**
 * TaskManagement
 *
 * @copyright Copyright © 2021 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use Magento\Framework\Exception\AlreadyExistsException;

class TaskManagement implements TaskManagementInterface
{
    private $resource;

    public function __construct(Task $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param TaskInterface $task
     * @return int
     * @throws AlreadyExistsException
     */
    public function save(TaskInterface $task): int
    {
        $this->resource->save($task);
        return $task->getTaskId();
    }

    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function delete(TaskInterface $task): bool
    {
        $this->resource->delete($task);
        return true;
    }
}
