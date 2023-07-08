<?php

namespace Modules\HR\Entities;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Modules\Salary\Entities\EmployeeSalary;
use Modules\User\Entities\User;

class Employee extends Model
{
    protected $guarded = [];

    protected $dates = ['joined_on'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hrJobDesignation()
    {
        return $this->belongsTo(HrJobDesignation::class, 'designation_id');
    }

    public function hrJobDomain()
    {
        return $this->belongsTo(HrJobDomain::class, 'domain_id');
    }

    public function scopeStatus($query, $status)
    {
        if ($status == 'current') {
            return $query->wherehas('user');
        } else {
            return $query->whereDoesntHave('user');
        }
    }

    public function scopeActive($query)
    {
        return $query->whereNotNull('user_id');
    }

    public function getEmploymentDurationAttribute()
    {
        if (is_null($this->user_id)) {
            return;
        } else {
            $now = now();

            return ($this->joined_on->diff($now)->days < 1) ? '0 days' : $this->joined_on->diffForHumans($now, 1);
        }
    }

    /**
     * Get the projects for the employees.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('contribution_type');
    }

    public function scopeApplyFilters($query, $filters)
    {
        if ($status = Arr::get($filters, 'status', '')) {
            $query = $query->status($status);
        }

        return $query;
    }

    public function employeeSalaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

    public function getFtes($startDate, $endDate)
    {
        $fte = 0;
        $fteAmc = 0;
        foreach ($this->user->projectTeamMembers()->with('project')->get() as $projectTeamMember) {
            if (! $projectTeamMember->project->is_amc) {
                $fte += $projectTeamMember->getFte($startDate, $endDate);
            }
            if ($projectTeamMember->project->is_amc) {
                $fteAmc += $projectTeamMember->getFte($startDate, $endDate);
            }
        }

        return ['main' => $fte, 'amc' => $fteAmc];
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'reviewee_id');
    }

    public function getOverallStatusAttribute()
    {
        $assessments = $this->assessments()
            ->whereRaw('YEAR(assessments.created_at) = YEAR(CURDATE())')
            ->whereRaw('QUARTER(assessments.created_at) = QUARTER(CURDATE())')
            ->first();
        $overallStatus = null;
        if ($assessments && $assessments->individualAssessments->isNotEmpty()) {
            $individualStatuses = $assessments->individualAssessments->pluck('status')->unique();

            if ($individualStatuses->count() === 1) {
                $overallStatus = $individualStatuses->first();
            } else {
                $overallStatus = 'in-progress';
            }
        }

        return $overallStatus;
    }

    public function getHRAttribute()
    {
        return self::find($this->hr_id);
    }

    public function getMentorAttribute()
    {
        return self::find($this->mentor_id);
    }

    public function getManagerAttribute()
    {
        return self::find($this->manager_id);
    }
}
