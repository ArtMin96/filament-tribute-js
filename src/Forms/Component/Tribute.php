<?php

namespace ArtMin96\FilamentTributeJs\Forms\Component;

use ArtMin96\FilamentTributeJs\Forms\Component\Concerns\TributeAttributes;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Tribute extends RichEditor
{
    use TributeAttributes;

    protected string $view = 'filament-tribute-js::forms.components.tribute';

    protected $mentionable;

    protected $taggable;

    protected bool $mention = true;

    protected bool $hashtag = true;

    public Collection $mentionables;

    public Collection $taggables;

    public function setUp(): void
    {
        parent::setUp();

        $this->mentionables = Collection::make();
        $this->taggables = Collection::make();
    }

    public function getMentionableModel(): string|Model
    {
        return $this->mentionable;
    }

    public function getTaggableModel(): string|Model
    {
        return $this->taggable;
    }

    public function getMention(): bool
    {
        return $this->mention;
    }

    public function getHashtag(): bool
    {
        return $this->hashtag;
    }

    public function mentionableModel(string|Model $mentionable): static
    {
        $this->mentionable = $mentionable;

        return $this;
    }

    public function taggableModel(string|Model $taggable): static
    {
        $this->taggable = $taggable;

        return $this;
    }

    public function getMentionables(): Collection
    {
        return $this->getMentionableModel()::all()
            ->map(function ($mention) {
                return [
                    'full_name' => $mention->name,
                    'username' => $mention->username,
                    'avatar' => $mention->profile_photo_url,
                    'details' => 'Some details about item.',
                ];
            });
    }

    public function getTaggables(): Collection
    {
        return $this->getTaggableModel()::all()
            ->map(function ($tag) {
                return [
                    'key' => $tag->name,
                    'value' => $tag->username,
                    'icon' => $tag->profile_photo_url,
                    'details' => 'Some details about item.',
                ];
            });
    }

    public function disableMention(): static
    {
        $this->mention = false;

        return $this;
    }

    public function disableHashtag(): static
    {
        $this->hashtag = false;

        return $this;
    }
}
