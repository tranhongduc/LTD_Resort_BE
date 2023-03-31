<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 
        'password', 
        'avatar', 
        'account_type',
        'enable',
        'role_id'
    ];

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
