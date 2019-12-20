<?php

namespace BlueSpice\WatchList\Panel;

use User;
use QuickTemplate;
use BlueSpice\Calumma\IPanel;
use BlueSpice\Calumma\Panel\BasePanel;

class WatchList extends BasePanel implements IPanel {
	/**
	 *
	 * @var array
	 */
	protected $params = [];

	/**
	 *
	 * @param QuickTemplate $sktemplate
	 * @param array $params
	 * @return WatchList
	 */
	public static function factory( $sktemplate, $params ) {
		return new self( $sktemplate, $params );
	}

	/**
	 *
	 * @param QuickTemplate $skintemplate
	 * @param array $params
	 * @return WatchList
	 */
	public function __construct( $skintemplate, $params ) {
		parent::__construct( $skintemplate );
		$this->params = $params;
	}

	/**
	 * @return \Message
	 */
	public function getTitleMessage() {
		return wfMessage( 'bs-watchlist-title-sidebar' );
	}

	/**
	 * @return string
	 */
	public function getBody() {
		$watchlistTitles = $this->getWatchlistTitles();
		$links = [];
		foreach ( $watchlistTitles as $watchlistTitle ) {
			$link = [
				'href' => $watchlistTitle['title']->getFullURL(),
				'text' => $watchlistTitle['displayText'],
				'title' => $watchlistTitle['displayText'],
				'classes' => ' bs-usersidebar-internal '
			];
			$links[] = $link;
		}

		$linkListGroup = new \BlueSpice\Calumma\Components\SimpleLinkListGroup( $links );

		return $linkListGroup->getHtml();
	}

	/**
	 *
	 * @return User
	 */
	protected function getUser() {
		return $this->skintemplate->getSkin()->getUser();
	}

	/**
	 *
	 * @return \Title
	 */
	protected function getTitle() {
		return $this->skintemplate->getSkin()->getTitle();
	}

	/**
	 *
	 * @return array
	 */
	protected function getWatchlistTitles() {
		$watchlist = [];

		$maxLength = 30;
		if ( isset( $this->params['maxtitlelength'] ) ) {
			$maxLength = (int)$this->params['maxtitlelength'];
		}

		$count = 7;
		if ( isset( $this->params['count'] ) ) {
			$count = (int)$this->params['count'];
		}

		$options = [];
		if ( isset( $this->params['order'] ) && $this->params['order'] == 'pagename' ) {
			$options['ORDER BY'] = 'wl_title';
		}
		$options['LIMIT'] = $count;

		$dbr = wfGetDB( DB_REPLICA );
		$res = $dbr->select(
			[ 'watchlist', 'page' ],
			[ 'wl_namespace', 'wl_title' ],
			[
				'wl_user' => $this->getUser()->getId(),
				'NOT wl_notificationtimestamp' => null,
				'wl_title = page_title',
				'wl_namespace = page_namespace',
				"page_content_model" => [ "", "wikitext" ]
			],
			__METHOD__,
			$options
		);

		foreach ( $res as $row ) {
			$watchedTitle = \Title::newFromText( $row->wl_title, $row->wl_namespace );
			if ( $watchedTitle instanceof \Title === false
				|| $watchedTitle->exists() == false ) {
				continue;
			}

			$displayText = \BsStringHelper::shorten(
				$watchedTitle->getPrefixedText(),
				[ 'max-length' => $maxLength, 'position' => 'middle' ]
			);

			$watchlist[] = [
				'title' => $watchedTitle,
				'displayText' => $displayText
			];
		}

		return $watchlist;
	}
}
