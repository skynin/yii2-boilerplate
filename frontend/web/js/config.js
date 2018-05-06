require.config({
   baseUrl: "/js",
	deps: ['sncommon'],
	urlArgs: function(id, url) {
		var args = 'v=' + AppConfig.version;
		return (url.indexOf('?') === -1 ? '?' : '&') + args;
    }
});