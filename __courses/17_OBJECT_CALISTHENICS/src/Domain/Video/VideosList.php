<?php

namespace Alura\Calisthenics\Domain\Video;

class VideosList
{
    private array $videos;

    public function add(Video $video): void
    {
        $this->videos[] = $video;
    }

    public function all(): array
    {
        return $this->videos;
    }
}