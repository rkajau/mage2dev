<?php

declare(strict_types=1);
namespace MageMastery\Todo\Api\Data;

/**
 * @api
 */
interface TaskInterface
{
    /**
     * @return int
     */
    public function getTaskId(): int;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @param int $taskId
     * @return void
     */
    public function setTaskId(int $taskId);

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status);

    /**
     * @param string $label
     * @return void
     */
    public function setLabel(string $label);

    /**
     * @param int $customerId
     * @return void
     */
    public function setCustomerId(int $customerId);
}
