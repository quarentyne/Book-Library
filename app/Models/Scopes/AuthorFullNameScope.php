<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class AuthorFullNameScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $tableName = $model->getTable();

        $builder->select($tableName . '.*')
            ->addSelect(DB::raw("CONCAT(`$tableName`.lastname, ' ', `$tableName`.firstname, ' ', `$tableName`.middlename) as fullname"));
    }
}
