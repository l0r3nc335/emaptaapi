<?php

/**
 * Declaration Model
 * Created by : Karl Pandacan
 * 2020-07-26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Declaration extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'mobile_number',
        'email',
        'age',
        'gender',
        'visitor_type',
        'nature_of_visit',
        'time_in',
        'time_out',
        'temperature',
        'company_name',
        'company_address',
        'employee_number',
        'health_check',
        'contact_covid',
        'contact_flu',
        'travelled_outside_ph',
        'travelled_ncr',
        'places_yesterday',
        'household_headcount',
        'symptoms_check',
        'ill_in_household',
        'ill_in_household_symptoms',
        'ill_in_household_how_long',
        'ill_in_household_is_examined',
        'ill_in_household_exam_result',
        'mass_gathering',
        'mass_gathering_yes',
        'household_mass_gathering',
        'household_mass_gathering_yes',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    const PER_PAGE = 15;
}
