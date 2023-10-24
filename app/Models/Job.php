<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'location',
        'salary',
        'description',
        'experience',
        'category',
    ];

    public static array $experience = ['junior', 'intermediate', 'senior'];
    public static array $category = ['Backend', 'Frontend', 'Fullstack', 'Devops', 'UI/UX', 'Mobile'];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(Authenticatable|User|int $user): bool
    {
        return $this->where('id', $this->id)
            ->whereHas(
                'jobApplications',
                fn($query) => $query->where('user_id', '=', $user->id ?? $user)
            )->exists();
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder
    {
        return $query->when($filters['search'] ?? null, fn($query, $search) => $this->search($query, $search))
            ->when($filters['min_salary'] ?? null, fn($query, $min_salary) => $this->filterByMinSalary($query, $min_salary))
            ->when($filters['max_salary'] ?? null, fn($query, $max_salary) => $this->filterByMaxSalary($query, $max_salary))
            ->when($filters['experience'] ?? null, fn($query, $experience) => $this->filterByExperience($query, $experience))
            ->when($filters['category'] ?? null, fn($query, $category) => $this->filterByCategory($query, $category));
    }

    private function search(Builder|QueryBuilder $query, $search): Builder|QueryBuilder
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('employer', function ($query) use ($search) {
                    $query->where('company_name', 'like', "%{$search}%");
                });
        });
    }

    private function filterByMinSalary(Builder|QueryBuilder $query, $min_salary): Builder|QueryBuilder
    {
        return $query->where('salary', '>=', $min_salary);
    }

    private function filterByMaxSalary(Builder|QueryBuilder $query, $max_salary): Builder|QueryBuilder
    {
        return $query->where('salary', '<=', $max_salary);
    }

    private function filterByExperience(Builder|QueryBuilder $query, $experience): Builder|QueryBuilder
    {
        return $query->where('experience', $experience);
    }

    private function filterByCategory(Builder|QueryBuilder $query, $category): Builder|QueryBuilder
    {
        return $query->where('category', $category);
    }
}