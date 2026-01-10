<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      RoleSeeder::class,
      RegionSeeder::class,
      UsersSeeder::class,
      DriverSeeder::class,
      ManagerSeeder::class,
      StudentSeeder::class,
      BusSeeder::class,
      SeatSeeder::class,
      BusSeatSeeder::class,
      RouteSeeder::class,
      TripSeeder::class,
      BookingSeeder::class,
      LaratrustSeeder::class,
    ]);
  }
}
