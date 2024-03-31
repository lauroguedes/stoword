<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveWordAndCreateHistoricJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $data,
        public User $user,
    ) {}

    public function handle(Word $word): void
    {
        $word = $word->firstOrCreate(
            ['name' => $this->data['name']],
           $this->data
        );

        if ($word->users->contains($this->user->id)){
            return;
        }

        $word->users()->attach($this->user->id);
    }
}
