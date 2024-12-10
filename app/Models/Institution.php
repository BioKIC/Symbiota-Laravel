<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model {
    use HasFactory;

    protected $primaryKey = 'iid';

    // TODO (Logan) fix typo in legacy create timestamp
    const CREATED_AT = 'IntialTimeStamp';

    const UPDATED_AT = 'modifiedTimeStamp';

    protected $fillable = [
        'institutionID',
        'InstitutionCode',
        'InstitutionName',
        'InstitutionName2',
        'Address1',
        'Address2',
        'City',
        'StateProvince',
        'PostalCode',
        'Country',
        'Phone',
        'Contact',
        'Email',
        'Url',
        'Notes',
        'modifieduid',
        'modifiedTimeStamp',
        'IntialTimeStamp',
    ];

    public function collections() {
        return $this->hasMany(Collections::class, 'collid', 'collid');
    }
}
