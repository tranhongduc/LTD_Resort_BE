<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Account extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 
        'email',
        'password', 
        'avatar', 
        'enabled',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    public function customer()
    {
    return $this->belongsTo(Customer::class);
    }
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *s
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // /**
    //  * Define an inverse one-to-one or many relationship.
    //  *
    //  * @param  string  $related
    //  * @param  string|null  $foreignKey
    //  * @param  string|null  $ownerKey
    //  * @param  string|null  $relation
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  * 
    //  * Get the admin associated with the account.
    //  */
    // public function admin()
    // {
    //     /**
    //      * $related là model muốn liên kết.
    //      * 
    //      * $foreignKey là column của bảng hiện tại sẽ dùng để liên kết. 
    //      * Mặc định $foreignKey sẽ là tên của phương thức cộng với primary key của $relatedModel.
    //      * 
    //      * $localKey là column của bảng $relatedModel sẽ dùng để liên kết. 
    //      * Mặc định $ownerKey là khóa chính của $relatedModel.
    //      * 
    //      * $foreignKey là khóa ngoại của bảng hiện tại
    //      */

    //     return $this->belongsTo(Account::class, 'account_id', 'account_id');
    // }
}
