<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lecturer
 *
 * @package App
 * @property string $name
 * @property string $school
 * @property integer $account_number
 * @property string $email
 * @property string $bank
 * @property string $department
 * @property string $referer_code
*/
class Lecturer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'school', 'account_number', 'email', 'bank', 'department', 'referer_code'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAccountNumberAttribute($input)
    {
        $this->attributes['account_number'] = $input ? $input : null;
    }
    
}
