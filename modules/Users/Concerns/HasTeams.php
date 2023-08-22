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

namespace Modules\Users\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Modules\Users\Models\Team;
use Modules\Users\Support\TeamCache;

/** @mixin \Modules\Core\Models\Model */
trait HasTeams
{
    /**
     * Get all of the teams the user belongs to
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withTimestamps()->as('membership');
    }

    /**
     * Get all of the teams the user manages
     */
    public function managedTeams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get all of the teams the user belongs to or manages
     */
    public function allTeams(): Collection
    {
        return $this->teams->merge($this->managedTeams)->sortBy('name');
    }

    /**
     * Determine if the user manages the given team
     */
    public function managesTeam(Team $team): bool
    {
        return $this->id == $team->{$this->getForeignKey()};
    }

    /**
     * Determine if the user manages any of the given user teams
     */
    public function managesAnyTeamsOf(int $userId): bool
    {
        return TeamCache::userManagesAnyTeamsOf($this->id, $userId);
    }

    /**
     * Determine if the user belongs to the given team
     */
    public function belongsToTeam(Team $team): bool
    {
        return $this->managesTeam($team) || $this->teams->contains(
            fn ($t) => $t->id === $team->id
        );
    }
}
