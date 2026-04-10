<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repositories\Eloquent\PostRepository;

class replaceLink extends Command
{

     /**
     * var
     * @var PostRepository
     */
    private $postRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:replace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command replace link ảnh';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( PostRepository $postRepository )
    {
        parent::__construct();
        $this->postRepository = $postRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->postRepository->replaceLinkImage();
        $this->postRepository->replaceLinkImageChangerForler();
    }
}
