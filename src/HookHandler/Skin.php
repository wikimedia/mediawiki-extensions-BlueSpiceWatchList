<?php

namespace BlueSpice\WatchList\HookHandler;

use MediaWiki\Hook\PersonalUrlsHook;
use SkinTemplate;
use Title;

class Skin implements PersonalUrlsHook {

	/**
	 * @param array &$personal_urls
	 * @param Title &$title
	 * @param SkinTemplate $skin
	 * @return void
	 */
	public function onPersonalUrls( &$personal_urls, &$title, $skin ): void {
		if ( !isset( $personal_urls['watchlist'] ) ) {
			return;
		}
		if ( !isset( $personal_urls['watchlist']['data'] ) ) {
			$personal_urls['watchlist']['data'] = [];
		}
		$personal_urls['watchlist']['data']['attentionindicator'] = 'watchlist';
	}

}
