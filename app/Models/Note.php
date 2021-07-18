<?php

namespace App\Models;

use App\Actions\Encryption\Encryption;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelVersionable\Versionable;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Versionable;

    /**
     * @var string $table
     */
    protected $table = 'notes';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'pinned',
        'order',
        'color',
        'title',
        'message',
    ];

    /**
     * @var string[] $versionable
     */
    protected $versionable = [
        'user_id',
        'pinned',
        'order',
        'color',
        'title',
        'message',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(
            User::class, 'id', 'user_id',
        );
    }

    /**
     * @param bool $raw
     * @return string
     */
    public function getTitleAttribute(bool $raw = true): string
    {
        if ($raw == true) {
            return $this->attributes['title'];
        }

        try {
            return Encryption::decrypt($this->attributes['title']);
        } catch (EnvironmentIsBrokenException|WrongKeyOrModifiedCiphertextException $exception) {
            return 'Data Encryption Cannot Be Decrypted!';
        }
    }

    /**
     * @param bool $raw
     * @return string
     */
    public function getMessageAttribute(bool $raw = true): string
    {
        if ($raw == true) {
            return $this->attributes['message'];
        }

        try {
            return Encryption::decrypt($this->attributes['message']);
        } catch (EnvironmentIsBrokenException|WrongKeyOrModifiedCiphertextException $exception) {
            return 'Data Encryption Cannot Be Decrypted!';
        }
    }
}
