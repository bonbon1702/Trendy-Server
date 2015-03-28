<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Services\interfaces\IPostService;
use Services\interfaces\IHistoryService;

class ZScoreCommand extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:ZScoreCommand';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make my day';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(IPostService $postService, IHistoryService $historyService)
	{
		parent::__construct();

        $this->postService = $postService;
        $this->historyService = $historyService;
	}

	/**
	 * When a command should run
	 *
	 * @param Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->daily()->hours(2)->minutes(22);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
        $post = $this->postService->allPost();
        $start_day = date("Y-m-d") . " 00:00:00";
        $end_day = date("Y-m-d") . " 23:59:59";

        foreach ($post as $v){
            $zScore = new \Core\ZScore($v->day,$v->interaction, $v->sqr_interaction);

            $like_count = $this->historyService->actionCount('like', $v->id, $start_day, $end_day);

            $comment_count = $this->historyService->actionCount('comment', $v->id, $start_day, $end_day);

            $favorite_count = $this->historyService->actionCount('favorite', $v->id, $start_day, $end_day);

            $interaction_now = $like_count + $comment_count * 2 + $favorite_count * 3;


            $score = $zScore->score($interaction_now);

            $data = array(
                'id' => $v->id,
                'day' => $v->day + 1,
                'interaction' => $v->interaction + $interaction_now,
                'sqr_interaction' => $v->sqr_interaction + pow($interaction_now, 2),
                'zScore' => $score
            );
            $this->postService->update($data);
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
        return [];
	}

}
