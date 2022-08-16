<?php

namespace BlueSpice\WatchList\ContentDroplets;

use MediaWiki\Extension\ContentDroplets\Droplet\TagDroplet;
use Message;
use RawMessage;

class WatchlistDroplet extends TagDroplet {

	/**
	 * @inheritDoc
	 */
	public function getName(): Message {
		return new RawMessage( 'Watchlist' );
	}

	/**
	 * @inheritDoc
	 */
	public function getDescription(): Message {
		return new RawMessage( "Watchlist description" );
	}

	/**
	 * @inheritDoc
	 */
	public function getIcon(): string {
		return 'unStar';
	}

	/**
	 * @inheritDoc
	 */
	public function getRLModule(): string {
		return 'ext.bluespice.watchlist.visualEditor';
	}

	/**
	 * @return array
	 */
	public function getCategories(): array {
		return [ 'lists' ];
	}

	/**
	 *
	 * @return string
	 */
	protected function getTagName(): string {
		return 'bs:watchlist';
	}

	/**
	 * @return array
	 */
	protected function getAttributes(): array {
		return [
			'count' => '1',
			'maxtitlelength' => '5',
			'order' => '',
			'pagename' => '',
			'time' => ''
		];
	}

	/**
	 * @return bool
	 */
	protected function hasContent(): bool {
		return false;
	}

	/**
	 * @return string|null
	 */
	public function getVeCommand(): ?string {
		return 'watchlistCommand';
	}

}
