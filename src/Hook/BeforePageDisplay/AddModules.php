<?php

namespace BlueSpice\WatchList\Hook\BeforePageDisplay;

use BlueSpice\Hook\BeforePageDisplay;

class AddModules extends BeforePageDisplay {

	protected function doProcess() {
		$this->out->addModules( 'ext.bluespice.watchlist.myWatchlistWindow.bootstrap' );

		return true;
	}

}
