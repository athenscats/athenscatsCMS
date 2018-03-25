<?php

namespace App\mylibrary;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;


class MyMenuFilter implements FilterInterface
{
    
    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) && ! Auth::user()->hasPermissionTo($item['permission'])) {            
            
            return false;
        }

       
        return $item;
    }
}