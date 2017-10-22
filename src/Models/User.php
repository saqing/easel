<?php

namespace Canvas\Models;

use Laravel\Scout\Searchable;
use Canvas\Helpers\CanvasHelper;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable, Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'canvas_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'display_name',
        'role',
        'url',
        'twitter',
        'facebook',
        'github',
        'linkedin',
        'resume_cv',
        'address',
        'city',
        'country',
        'bio',
        'job',
        'phone',
        'gender',
        'relationship',
        'birthday',
        'email',
        'password',
    ];

    /**
     * Cast attributes to specific types.
     *
     * @var array
     */
    protected $casts = ['role' => 'integer'];

    /**
     * Get the posts relationship.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Return TRUE if the user is an administrator.
     *
     * @param $role
     *
     * @return bool
     */
    public static function isAdmin($role)
    {
        return $role === CanvasHelper::ROLE_ADMINISTRATOR ? true : false;
    }

    /**
     * Get the number of posts by a user.
     *
     * @param $userId
     *
     * @return bool
     */
    public static function postCount($userId)
    {
        return Post::where('user_id', $userId)->get()->count();
    }
}
