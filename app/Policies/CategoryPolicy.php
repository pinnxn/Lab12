<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function update(User $user)
    {
        return $user->isAdministrator();
    }
    function delete(User $user, Category $category)
    {

        $category->loadCount('products');
        return $this->update($user) && ($category->products_count === 0);
    }
}
