<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        // Security & Identification
        'case_number',
        'password', // Renamed from case_password to match migration

        // Survivor / Personal Info
        'fullname',
        'gender',
        'age_range',
        // Contact & ID
        'phone_number',
        'email_address',
        'national_id',
        'passport_number',

        // Incident Details
        'tfgbv_type',
        'platform_of_abuse',
        'platform_url', // Added to match migration
        'incident_date',
        'incident_time',
        'description',

        // Perpetrator Details
        'perpetrator_name',
        'perpetrator_phone',
        'perpetrator_email',
        'perpetrator_age',
        'relationship_with_perpetrator',

        // Geography & Specifics
        'survivor_county',
        'survivor_subcounty',
        'survivor_ward',
        'specific_survivor_needs',

        // Outcomes & Evidence
        'report_to_police',
        'recommend_counselling',
        'evidence_of_abuse',
    ];
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // <-- Automatically hashes
        ];
    }
}
