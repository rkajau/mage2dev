<?php
/**
 * CustomerTaskList
 *
 * @copyright Copyright © 2021 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

declare(strict_types=1);
namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\CustomerTaskListInterface;
use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CustomerTaskList implements CustomerTaskListInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * CustomerTaskList constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return TaskInterface|TaskInterface[]
     */
    public function getList()
    {
        return $this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }
}
