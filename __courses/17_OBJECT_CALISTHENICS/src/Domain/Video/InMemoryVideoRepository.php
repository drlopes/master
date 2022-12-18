<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;
use self;

class InMemoryVideoRepository implements VideoRepository
{
    private VideosList $videos;

    public function __construct() {
        $this->videos = new VideosList();
    }

    public function add(Video $video): self
    {
        $this->videos->add($video);

        return $this;
    }

    public function videosFor(Student $student): array
    {
        return array_filter($this->videos->all(), fn (Video $video) => $video->getAgeLimit() <= $student->age());
    }
}
