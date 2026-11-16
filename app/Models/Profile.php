<?php

namespace App\Models;

use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'full_name',
    'role',
    'class_name',
    'competency',
    'tagline',
    'bio',
    'avatar_path',
    'cv_path',
    'email',
    'github_url',
    'instagram_url',
    'linkedin_url',
    'career_goal',
    'interests',
])]
class Profile extends Model
{
    /** @use HasFactory<ProfileFactory> */
    use HasFactory;

    public static function current(): self
    {
        $owner = config('portfolio.owner');

        return static::query()->firstOrCreate([], [
            'full_name' => $owner['name'],
            'role' => $owner['role'],
            'class_name' => 'XII RPL 1',
            'competency' => 'Rekayasa Perangkat Lunak',
            'tagline' => $owner['motto'],
            'bio' => 'Siswa SMKN 2 Banjarmasin yang berfokus pada pengembangan aplikasi web, mobile, dan solusi IoT.',
            'email' => $owner['email'],
            'github_url' => $owner['github'],
            'instagram_url' => $owner['instagram'],
            'linkedin_url' => $owner['linkedin'],
            'career_goal' => 'Menjadi software engineer profesional yang membangun produk digital berdampak bagi masyarakat.',
            'interests' => 'Web Development, Mobile Development, Internet of Things, UI/UX Design',
        ]);
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return filled($this->avatar_path)
            ? Storage::disk('public')->url($this->avatar_path)
            : null;
    }

    public function getCvUrlAttribute(): ?string
    {
        return filled($this->cv_path)
            ? Storage::disk('public')->url($this->cv_path)
            : null;
    }

    /**
     * @return list<string>
     */
    public function getInterestListAttribute(): array
    {
        return collect(preg_split('/[,\n]/', (string) $this->interests))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @return list<array{label: string, url: string, icon: string}>
     */
    public function getSocialLinksAttribute(): array
    {
        $links = [];

        if (filled($this->email)) {
            $links[] = ['label' => 'Email', 'url' => 'mailto:'.$this->email, 'icon' => 'mail'];
        }

        if (filled($this->github_url)) {
            $links[] = ['label' => 'GitHub', 'url' => $this->github_url, 'icon' => 'github'];
        }

        if (filled($this->instagram_url)) {
            $links[] = ['label' => 'Instagram', 'url' => $this->instagram_url, 'icon' => 'instagram'];
        }

        if (filled($this->linkedin_url)) {
            $links[] = ['label' => 'LinkedIn', 'url' => $this->linkedin_url, 'icon' => 'linkedin'];
        }

        return $links;
    }
}
