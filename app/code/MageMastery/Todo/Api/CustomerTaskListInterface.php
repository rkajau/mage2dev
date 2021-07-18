<?php

namespace MageMastery\Todo\Api;

/**
 * @api
 */
interface CustomerTaskListInterface
{
    /**
     * @return MageMastery\Todo\Api\Data\TaskInterface[]
     */
    public function getList();
}
