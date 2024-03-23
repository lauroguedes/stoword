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

    public function __construct(private readonly Word $word)
    {
    }

    public function handle(array $wordData, User $user): void
    {
        $word = $this->word->createOrFirst(
            ['name' => $wordData['name']],
           $wordData
        );

        if ($word->users->contains($user->id)){
            return;
        }

        $word->users()->attach($user->id);
    }
}
