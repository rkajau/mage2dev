<?php

declare(strict_types=1);

namespace MageMastery\Todo\Test\Unit\Service;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Service\CustomerTaskList;
use MageMastery\Todo\Service\TaskRepository;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\Api\SearchCriteriaInterface;

class CustomerTaskListTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $taskRepository;

    /**
     * @var MockObject
     */
    private $searchCriteriaBuilder;

    /**
     * @var MockObject
     */
    private $searchCriteria;

    /**
     * @var MockObject
     */
    private $searchCriteriaInterface;

    /**
     * @var MockObject
     */
    private $taskSearchResult;

    protected function setUp(): void
    {
        /*$this->taskRepository = $this->getMockForAbstractClass(
            TaskRepositoryInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getList'],
        );*/

        $this->taskRepository = $this->getMockBuilder(TaskRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['getList'])
            ->getMock();

        $this->searchCriteriaBuilder = $this->getMockBuilder(SearchCriteriaBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->searchCriteria = $this->getMockBuilder(SearchCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchCriteriaInterface = $this->getMockBuilder(SearchCriteriaInterface::class)
            ->getMock();

        $this->taskSearchResult = $this->getMockForAbstractClass(
            TaskSearchResultInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getItems'],
        );
    }

    public function testGetTest()
    {
        $expectedTaskLabel = 'Mage Mastery';
        $expectedTaskLabel2 = 'My Unit Test';

        $task1 = $this->getMockForAbstractClass(
            TaskInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getLabel'],
        );

        $task1->expects($this->any())
            ->method('getLabel')
            ->willReturn($expectedTaskLabel);

        $task2 = $this->getMockForAbstractClass(
            TaskInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getLabel'],
        );

        $task2->expects($this->any())
            ->method('getLabel')
            ->willReturn($expectedTaskLabel2);

        $this->taskRepository->expects($this->any())
            ->method('getList')
            ->with($this->searchCriteria)
            ->willReturn($this->taskSearchResult);

        $this->taskSearchResult->expects($this->any())
            ->method('getItems')
            ->willReturn([$task1, $task2]);

        $this->searchCriteriaBuilder->expects($this->any())
            ->method('create')
            ->willReturn($this->searchCriteria);

        $object = new CustomerTaskList(
            $this->taskRepository,
            $this->searchCriteriaBuilder
        );

        $tasks = $object->getList();

        $this->assertNotEmpty($tasks);
    }
}
