<?php

namespace App\Filters;

trait Relation {

    public static function findRelation($query, $relationName)
    {
        return $query->whereHas($relationName);
    }

}
