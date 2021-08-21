<?php

use App\Models\Event;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

/**
 * イベント
 * Class EventsTableSeeder
 */
class EventsTableSeeder extends Seeder
{
    private CarbonImmutable $now;

    /**
     * EventsTableSeeder constructor.
     */
    public function __construct()
    {
        $this->now = CarbonImmutable::now();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->insertEvents();
        });
    }

    /**
     * イベントを登録する
     */
    public function insertEvents(): void
    {
        $data = LazyCollection::range(1, 10)
            ->map(fn ($num) => [
                'title' => "タイトル{$num}",
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ])->all();
        Event::insert($data);
    }
}
