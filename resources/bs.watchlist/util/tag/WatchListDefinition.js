bs.util.registerNamespace( 'bs.watchlist.util.tag' );
bs.watchlist.util.tag.WatchListDefinition = function BsVecUtilTagWatchListDefinition() {
	bs.watchlist.util.tag.WatchListDefinition.super.call( this );
};

OO.inheritClass( bs.watchlist.util.tag.WatchListDefinition, bs.vec.util.tag.Definition );

bs.watchlist.util.tag.WatchListDefinition.prototype.getCfg = function() {
	var cfg = bs.watchlist.util.tag.WatchListDefinition.super.prototype.getCfg.call( this );
	return $.extend( cfg, {
		classname : 'Watchlist',
		name: 'watchlist',
		tagname: 'bs:watchlist',
		descriptionMsg: 'bs-watchlist-tag-watchlist-desc',
		menuItemMsg: 'bs-watchlist-ve-watchlistinspector-title',
		attributes: [{
			name: 'count',
			labelMsg: 'bs-watchlist-ve-watchlist-attr-count-label',
			helpMsg: 'bs-watchlist-tag-watchlist-attr-count-help',
			type: 'number'
		},{
			name: 'maxtitlelength',
			labelMsg: 'bs-watchlist-ve-watchlist-attr-maxtitlelength-label',
			helpMsg: 'bs-watchlist-tag-watchlist-attr-maxtitlelength-help',
			type: 'number'
		},{
			name: 'order',
			labelMsg: 'bs-watchlist-ve-watchlist-attr-order-label',
			helpMsg: 'bs-watchlist-tag-watchlist-attr-order-help',
			type: 'text'
		},{
			name: 'pagename',
			labelMsg: 'bs-watchlist-ve-watchlist-attr-pagename-label',
			helpMsg: 'bs-watchlist-tag-watchlist-attr-pagename-help',
			type: 'text'
		},{
			name: 'time',
			labelMsg: 'bs-watchlist-ve-watchlist-attr-time-label',
			helpMsg: 'bs-watchlist-tag-watchlist-attr-time-help',
			type: 'text'
		}]
	});
};

bs.vec.registerTagDefinition(
	new bs.watchlist.util.tag.WatchListDefinition()
);
