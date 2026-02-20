<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionSetting extends Model
{
    protected $fillable = ['section_name', 'title', 'subtitle', 'is_enabled', 'order'];

    protected function casts(): array
    {
        return ['is_enabled' => 'boolean'];
    }

    public static function getSection(string $name): ?self
    {
        return self::where('section_name', $name)->first();
    }

    public static function isEnabled(string $name): bool
    {
        $section = self::getSection($name);
        return $section ? $section->is_enabled : true;
    }
}
