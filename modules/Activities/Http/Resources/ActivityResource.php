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

namespace Modules\Activities\Http\Resources;

use App\Http\Resources\ProvidesCommonData;
use Illuminate\Http\Request;
use Modules\Comments\Http\Resources\CommentResource;
use Modules\Core\Http\Resources\MediaResource;
use Modules\Core\Resource\Http\JsonResource;
use Modules\Users\Http\Resources\UserResource;

/** @mixin \Modules\Activities\Models\Activity */
class ActivityResource extends JsonResource
{
    use ProvidesCommonData;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Modules\Core\Resource\Http\ResourceRequest  $request
     */
    public function toArray(Request $request): array
    {
        return $this->withCommonData([
            'is_reminded' => $this->isReminded,
            'is_completed' => $this->isCompleted,
            'completed_at' => $this->completed_at,
            'is_due' => $this->is_due,
            'created_by' => $this->created_by,
            'creator' => new UserResource($this->whenLoaded('creator')),
            $this->mergeWhen(! $request->isZapier(), [
                'comments' => CommentResource::collection($this->whenLoaded('comments')),
                'comments_count' => (int) $this->comments_count ?: 0,
                'media' => MediaResource::collection($this->whenLoaded('media')),
            ]),
        ], $request);
    }
}
