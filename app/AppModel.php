<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\AppModel
 *
 * @method static Builder|AppModel newModelQuery()
 * @method static Builder|AppModel newQuery()
 * @method static Builder|AppModel query()
 * @mixin Eloquent
 */
class AppModel extends Model
{
    public const IS_PUBLIC = 1;
    public const IS_PRIVATE = 0;
    public const IS_CHECKED = 'checked';

    /**
     * Set private status the property
     */
    public function setPrivate(): void
    {
        $this->status = self::IS_PRIVATE;
        $this->save();
    }

    /**
     * Set public status the property
     */
    public function setPublic(): void
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    /**
     * Toggle status the property
     *
     * @param $value
     */
    public function toggleStatus($value): void
    {
        if($value === null)
        {
            $this->setPrivate();
            return;
        }

        $this->setPublic();
    }

    /**
     * Set checkbox status
     *
     * @param $state
     * @return string
     */
    public static function isChecked($state)
    {
        return $state ? self::IS_CHECKED : '';
    }
}
