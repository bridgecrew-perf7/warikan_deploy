<?php

use App\Models\Event;
use App\Models\Payment;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Faker\Generator;

/**
 * 支払い
 * Class PaymentsTableSeeder
 */
class PaymentsTableSeeder extends Seeder
{
    private CarbonImmutable $now;
    private Generator $faker;

    /**
     * EventsTableSeeder constructor.
     */
    public function __construct()
    {
        $this->now = CarbonImmutable::now();
        $this->faker = Factory::create('ja_JP');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->insertPayments();
            $this->insertPayments();
            $this->insertPayments();
        });
    }

    /**
     * 支払いを登録する
     */
    public function insertPayments(): void
    {
        $memo = $this->faker->realText(30);
        $eventIds = Event::pluck('id');
        $data = $eventIds
            ->map(fn ($id) => [
                'event_id' => $id,
                'payer_id' => $this->faker->randomElement([1, 2]),
                'title' => "タイトル{$id}",
                'price' => $this->faker->numberBetween(1000, 10000),
                'memo' => $memo,
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ])->all();
        Payment::insert($data);
    }
}
