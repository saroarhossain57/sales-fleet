<?php
/**
 * Concord CRM - https://www.concordcrm.com
 *
 * @version   1.2.0
 *
 * @link      Releases - https://www.concordcrm.com/releases
 * @link      Terms Of Service - https://www.concordcrm.com/terms
 *
 * @copyright Copyright (c) 2022-2023 KONKORD DIGITAL
 */

namespace Modules\Core\Microsoft\Services\Batch;

class BatchDeleteRequest extends BatchRequest
{
    /**
     * Get request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'DELETE';
    }
}
