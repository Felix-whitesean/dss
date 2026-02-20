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
        'guardian_phone_number',

        // Incident Details
        'tfgbv_type',
        'platform_of_abuse',
        'new_platform_name',
        'evidence_url', // Added to match migration
        'description',

        // Perpetrator Details
        'relationship_with_perpetrator',

        // Geography & Specifics
        'disability_status',

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
