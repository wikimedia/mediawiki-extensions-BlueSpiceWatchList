<?php

namespace BlueSpice\WatchList\AttentionIndicator;

use BlueSpice\Data\FieldType;
use BlueSpice\Data\Filter\Boolean;
use BlueSpice\Data\Filter\Numeric;
use BlueSpice\Data\ReaderParams;
use BlueSpice\Data\Watchlist\Record;
use BlueSpice\Data\Watchlist\Store;
use BlueSpice\Discovery\AttentionIndicator;
use RequestContext;

class WatchList extends AttentionIndicator {

	/**
	 * @return bool
	 */
	public function hasIndication(): bool {
		$res = ( new Store( RequestContext::getMain(), false ) )->getReader()->read(
			new ReaderParams( $this->makeReaderParams() )
		);
		return $res->getTotal() > 0;
	}

	/**
	 * @return array
	 */
	protected function makeReaderParams(): array {
		return [
			ReaderParams::PARAM_FILTER => [ [
					Boolean::KEY_COMPARISON => Boolean::COMPARISON_EQUALS,
					Boolean::KEY_PROPERTY => Record::HAS_UNREAD_CHANGES,
					Boolean::KEY_TYPE => FieldType::BOOLEAN,
					Boolean::KEY_VALUE => true,
				], [
					Numeric::KEY_COMPARISON => Numeric::COMPARISON_EQUALS,
					Numeric::KEY_PROPERTY => Record::USER_ID,
					Numeric::KEY_TYPE => 'numeric',
					Numeric::KEY_VALUE => $this->user->getId(),
				],
			],
			// for now until we support the number $this->getIndicationCount()
			ReaderParams::PARAM_LIMIT => 1,
		];
	}

}
