<?php


namespace Alish\ActiveableModel\Traits;

use Alish\ActiveableModel\Models\ActiveableModel;
use Alish\ActiveableModel\Scopes\ActiveableScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;

/**
 * @method static Builder actives()
 * @property bool is_active
 */
trait IsActiveable
{
    protected bool $defaultStatus = true;

    protected static function bootHasStatus() {
        static::addGlobalScope(new ActiveableScope());
    }

    public function activeStates(): MorphMany
    {
        return $this->morphMany(ActiveableModel::class, 'object');
    }

    public function scopeActives(Builder $query)
    {
        return $query->where(function ($query) {
            $query->where(function ($query) {
                $query->select('is_active')
                    ->from('statuses')
                    ->whereColumn('object_id', $this->getTable() . '.id')
                    ->where('object_type', get_class($this))
                    ->latest('created_at')
                    ->latest('id')
                    ->limit(1);
            }, '=', 1)
                ->when(
                    $this->defaultStatus,
                    fn($query) => $query->orWhere(
                        fn($query) => $query->doesntHave('statuses')
                    )
                );
        });
    }

    protected function isActive(): bool
    {
        /** @var ActiveableModel $latestStatus */
        $latestStatus = $this->activeStates()
            ->latest('created_at')
            ->first();

        if (is_null($latestStatus)) {
            return $this->defaultStatus;
        }

        return $latestStatus->is_active;
    }

    public function activate(): bool
    {
        $this->activeStates()->create([
            'is_active' => true
        ]);

        $this->setAttribute('is_active', true);

        return true;
    }

    public function deactivate(): bool
    {
        $this->activeStates()->create([
            'is_active' => false
        ]);

        $this->setAttribute('is_active', false);

        return true;
    }

    public function getIsActiveAttribute()
    {
        if (Arr::has($this->attributes, 'is_active')) {

            if (is_null($this->attributes['is_active'])) {
                return $this->defaultStatus;
            }

            return (bool) $this->attributes['is_active'];
        }

        $this->setAttribute('is_active', $isActive = $this->isActive());

        return is_null($isActive) ? $this->defaultStatus : $isActive;
    }
}
