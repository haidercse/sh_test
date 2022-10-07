<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationQualification extends Model
{
    use HasFactory;
    /**
     * Get the exam that owns the EducationQualification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class,'exam_id','id');
    }
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
