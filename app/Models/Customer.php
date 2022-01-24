<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Attributes\Models\Attribute as RinvexAttribute;
use Rinvex\Attributes\Traits\Attributable;

class Customer extends RinvexAttribute
{
    use HasFactory;

    use \Rinvex\Attributes\Traits\Attributable;
    protected $with = ['eav', 'first_name'];


    // protected $fillable = ['first_name', 'last_name', 'age', 'gender', 'birthdate', 'address'];

    
    // public function getFirstNameAttribute(){
    // 	return $entity->first_name->add('Alvin');
    // }
    // public function getLastNameAttribute(){
    // }
    // public function getAgeAttribute(){
    // }
    // public function getGenderAttribute(){
    // }

    // public function getBirthdateAttribute(){
    // }
    // public function getAddressAttribute(){
    // }

}
