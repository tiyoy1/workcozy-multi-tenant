<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipFactory> */
    use HasFactory;

    protected $fillable = ['membership_role', 'user_id', 'workspace_id'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function workspace() : BelongsTo {
        return $this->belongsTo(Workspace::class);
    }

}
