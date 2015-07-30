<?php 
namespace Folklore\Image;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

class ImageServiceProvider extends ServiceProvider 
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// publish Config file	
		// config file
		$configFile = __DIR__ . '/../../resources/config/image.php';

		//target config path
		$dirConfig = app()->basePath().'/config';
		$targetConfigFile = app()->basePath().'/config/image.php';

		// check for the image.php file in the config directory on the base path 
		if(!file_exists($targetConfigFile)){
			$file = new Filesystem();

			// checks for the config directory in the base path
			if(!$file->isDirectory($dirConfig)){
				// create config directory in the base path
				$file->makeDirectory($dirConfig, 755, false, true);
			}

			// copy the image.php file to the config directory in the base path
			$file->copy($configFile,$targetConfigFile);
		}

		$app = $this->app;

		//Serve image
		if($this->app['config']['image.serve_image']){
			// Create a route that match pattern
			$pathPattern = $app['image']->pattern();
			$app->make('router')
				->get('{path}', array(
					'uses' => 'Folklore\Image\ImageController@serve'
				))
				->where('path', $pathPattern);
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('image', function($app)
		{
			return new ImageManager($app);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('image');
	}

}
