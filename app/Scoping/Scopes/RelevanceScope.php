<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class RelevanceScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        // <option value="relevance">Relevance</option>
        // <!-- <option value="">Most Popular</option> -->
        // <option value="recently-added">Recently Added</option>
        // <option value="low-price">Lowest price</option>
        // <option value="high-price">Highest price</option>
        // <option value="thc-low-to-high">THC%: low to high</option>
        // <option value="thc-high-to-low">THC%: high to low</option>
        // <option value="cbd-low-to-high">CBD%: low to high</option>
        // <option value="cbd-high-to-low">CBD%: high to low</option>

        if($value == 'relevance') {

            return $builder;

        } else if($value == 'recently-added') {

           return $builder->orderBy('created_at', 'desc');

        } else if($value == 'low-price') {

           return $builder->orderBy('price',  'asc');

        } else if($value == 'high-price') {

           return $builder->orderBy('price',  'desc');

        } else if($value == 'thc-low-to-high') {

            return $builder->whereNotNull('thc_percentage')->orderBy('thc_percentage', 'asc');

        } else if($value == 'thc-high-to-low') {

            return $builder->whereNotNull('thc_percentage')->orderBy('thc_percentage', 'desc');

        } else if($value == 'cbd-low-to-high') {

            return $builder->whereNotNull('cbd_percentage')->orderBy('cbd_percentage', 'asc');

        } else if($value == 'cbd-high-to-low') {

            return $builder->whereNotNull('cbd_percentage')->orderBy('cbd_percentage', 'desc');
        }
    }
}
