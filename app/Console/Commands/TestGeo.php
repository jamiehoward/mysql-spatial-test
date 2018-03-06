<?php
namespace App\Console\Commands;

use App\Place;
use Illuminate\Console\Command;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;

class TestGeo extends Command
{
    const MILE_DISTANCE = .019; // How many miles equate to GIS distance. This can be tweaked.

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:geo {distance} {latitude=34.183964} {longitude=-84.219542}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $input = new Point($this->argument('latitude'), $this->argument('longitude'));

        $distance = self::MILE_DISTANCE * $this->argument('distance');

        $results = Place::distance('location', $input, $distance);

        foreach ($results->get() as $place) {
            $this->info($place->name);
        }
    }
}
