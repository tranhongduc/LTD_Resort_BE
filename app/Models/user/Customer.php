<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'gender',
        'birthday',
        'email',
        'CMND',
        'address',  
        'phone',
        'ranking_point',
        'account_id',
        'ranking_id'
    ];
    
    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @param  string  $related
     * @param  string|null  $foreignKey
     * @param  string|null  $ownerKey
     * @param  string|null  $relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     * Get the account that owns the admin.
     */
    public function account()
    {
        /**
         * $related là model muốn liên kết.
         * 
         * $foreignKey là column của bảng hiện tại sẽ dùng để liên kết. 
         * Mặc định $foreignKey sẽ là tên của phương thức cộng với primary key của $relatedModel.
         * 
         * $localKey là column của bảng $relatedModel sẽ dùng để liên kết. 
         * Mặc định $ownerKey là khóa chính của $relatedModel.
         * 
         * $foreignKey là khóa ngoại của bảng hiện tại
         */

        return $this->belongsTo(Account::class);
    }
}
