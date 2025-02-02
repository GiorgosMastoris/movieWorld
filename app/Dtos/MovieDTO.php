<?php

namespace App\Dtos;

use App\Models\User;

class MovieDTO extends BaseDTO
{
    public string $id;
    public string $title;
    public ?string $description;
    public User $user;
    public string $date_of_publication;
    public int $like = 0;
    public int $hate = 0;
    public array $votes = [
        'like' => 0,
        'hate' => 0,
    ];

    protected function initialize(): void
    {
        $this->id = $this->data['id'];
        $this->title = $this->data['title'] ?? '';
        $this->description = $this->data['description'] ?? null;
        $this->user = $this->data['user'];
        $this->date_of_publication = $this->data['date_of_publication'] ?? '';

        if (isset($this->data['votes']) && is_array($this->data['votes'])) {
            // Extract the "type" values
            $types = array_column($this->data['votes'], 'type');
            $typeCounts = array_count_values($types);
            $this->votes = $this->data['votes'];
            $this->like = $typeCounts['like'] ?? 0;
            $this->hate = $typeCounts['hate'] ?? 0;
        }
    }

    public function validate(): bool
    {

        return true;
    }

    // Optional: Method to count the votes (like and hate)
    public function countVotes(): array
    {
        $likeCount = 0;
        $hateCount = 0;

        foreach ($this->votes as $vote) {
            if ($vote['type'] === 'like') {
                $likeCount++;
            } elseif ($vote['type'] === 'hate') {
                $hateCount++;
            }
        }

        return ['like' => $likeCount, 'hate' => $hateCount];
    }
}
