<?php
/**
 * TaskStatusManagement
 *
 * @copyright Copyright © 2021 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Api\TaskStatusManagementInterface;
use MageMastery\Todo\Model\Task;

class TaskStatusManagement implements TaskStatusManagementInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $repository;

    /**
     * @var TaskManagementInterface
     */
    private $management;

    /**
     * TaskStatusManagement constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param TaskManagementInterface $taskManagement
     */
    public function __construct(
        TaskRepositoryInterface $taskRepository,
        TaskManagementInterface $taskManagement
    ) {
        $this->repository = $taskRepository;
        $this->management = $taskManagement;
    }

    public function change(int $taskId, string $status): bool
    {
        if (!in_array($status, ['open', 'complete'])) {
            return false;
        }

        $task = $this->repository->get($taskId);
        $task->setData(Task::STATUS, $status);

        $this->management->save($task);

        return true;
    }
}
