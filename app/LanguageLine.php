<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LanguageLine extends Model
{
    /** @var array */
    public array $translatable = ['text'];

    /** @var array<string> */
    protected $guarded = ['id'];

    /** @var array */
    protected $casts = [
        'text' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saved(fn(self $languageLine) => $languageLine->flushGroupCache());
        static::deleted(fn(self $languageLine) => $languageLine->flushGroupCache());
    }

    public static function getTranslationsForGroup(string $locale, string $group): array
    {
        return Cache::rememberForever(
            static::getCacheKey($group, $locale),
            function () use ($group, $locale) {
                return static::query()
                    ->where('group', $group)
                    ->get()
                    ->reduce(function (array $lines, self $languageLine) use ($locale, $group) {
                        $translation = $languageLine->getTranslation($locale);

                        if ($translation !== null) {
                            if ($group === '*') {
                                $lines[$languageLine->key] = $translation;
                            } else {
                                Arr::set($lines, $languageLine->key, $translation);
                            }
                        }

                        return $lines;
                    }, []);
            }
        );
    }

    public static function getCacheKey(string $group, string $locale): string
    {
        return "spatie.translation-loader.{$group}.{$locale}";
    }

    public function getTranslation(string $locale): ?string
    {
        return $this->text[$locale] ?? $this->text[config('app.fallback_locale')] ?? null;
    }

    public function setTranslation(string $locale, string $value): self
    {
        $this->text = array_merge($this->text ?? [], [$locale => $value]);
        return $this;
    }

    public function flushGroupCache(): void
    {
        foreach ($this->getTranslatedLocales() as $locale) {
            Cache::forget(static::getCacheKey($this->group, $locale));
        }
    }

    protected function getTranslatedLocales(): array
    {
        return array_keys($this->text ?? []);
    }
}
