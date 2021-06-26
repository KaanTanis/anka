<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Keygen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '_key:gen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
     * @return int
     */
    public function handle()
    {
        echo self::generate();
    }

    public static function generate()
    {
        $server_name = sha1(md5( config('app.url'), true));
        return implode( '-', str_split( substr( strtoupper( $server_name ), 0, 12 ), 4 ) );
    }

    public static function _key(): bool
    {
        return config('app._key') == self::generate();
    }
}
