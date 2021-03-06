<?php namespace Fenos\Notifynder\Artisan;

use Fenos\Notifynder\Categories\NotifynderCategory;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class CategoryDelete extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'notifynder:category-delete';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete a category by ID or Name given';

    /**
     * @var \Fenos\Notifynder\Categories\NotifynderCategory
     */
    private $notifynderCategory;

    /**
     * Create a new command instance.
     *
     * @param \Fenos\Notifynder\Categories\NotifynderCategory $notifynderCategory
     * @return \Fenos\Notifynder\Artisan\CategoryDelete
     */
	public function __construct(NotifynderCategory $notifynderCategory)
	{
		parent::__construct();
        $this->notifynderCategory = $notifynderCategory;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $indentifier = $this->argument('identifier');

        if ($this->isIntegerValue($indentifier))
        {
            $delete = $this->notifynderCategory->delete($indentifier);
        }
        else
        {
            $delete = $this->notifynderCategory->deleteByName($indentifier);
        }

        if ($delete)
        {
            $this->info('Category has been deleted');
        }
        else
        {
            $this->error('Category Not found');
        }
	}

    public function isIntegerValue($indentifier)
    {
        return preg_match('/[0-9]/',$indentifier);
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('identifier', InputArgument::REQUIRED, '1 - nameCategory'),
		);
	}
}
