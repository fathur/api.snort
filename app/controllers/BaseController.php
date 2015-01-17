<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			/*View::share('description','');
			View::share('direction','ltr');
			View::share('googleAnalytics','');
			View::share('icon','');
			View::share('keywords','');
			View::share('lang','id_ID');
			View::share('logo','');
			View::share('title',"Meubel Jepara");
			
			$this->layout = View::make($this->layout);*/
		}
	}

}
