<?php

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
	static $mainJsApp = 'snapp';

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css?v='. APP_VERSION,
    ];
    public $js = [
		'https://cdnjs.cloudflare.com/ajax/libs/riot/3.9.5/riot+compiler.min.js',
		'js/require.js',
		'js/config.js?v='. APP_VERSION,
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset'
    ];

	function init ()
	{
		parent::init();
		self::$thisInstance = $this;
	}

	static $thisInstance;
	static function endBody()
	{
		echo PHP_EOL;
?>
<script>
	require.config({
	baseUrl: "/js/src"
	});
  require(['<?= self::$mainJsApp?>']);
</script>
<?= self::echoRiotTag() ?>
<?php
	}

	public static $tagsDir;
	protected static $tags = [];
	static function tags(array $tags)
	{
		self::$tagsDir = self::$tagsDir ?? Yii::getAlias( '@frontend/tags' );

		foreach ( $tags as $eachTag => $pathTag ) {
			if ( is_string($eachTag) )
				self::$tags[$eachTag] = self::$tagsDir . '/' . $pathTag;
			else
				self::$tags[$pathTag] = self::$tagsDir;
		}
	}

    protected static function echoRiotTag($tagName = null, $tagsDir = null)
    {
        $result = '';

		if ($tagName === null) $tagName = self::$tags;

        if ( is_array( $tagName )) {
            foreach ( $tagName as $eachTag => $pathTag) {
                $result .= self::echoRiotTag($eachTag, $pathTag);
            }
            return $result;
        }

        if (empty($tagsDir)) $tagsDir = self::$tagsDir ?? Yii::getAlias( '@frontend/tags' );

		$fileTag = $tagsDir . '/' . $tagName . '.tag.html';

		if (!file_exists($fileTag)) {
			Yii::error([
				'fileTag' => $fileTag,
				'tagName' => $tagName,
				'tagsDir' => $tagsDir,
				'all::tags' => self::$tags
			]);

			return '';
		}

        $result = '<script type="riot/tag">' . PHP_EOL;
        $ttt = file_get_contents($fileTag);

		$ttt = preg_replace('#//.*|<!--(.|\s)*?-->\s*|/\*(.|\s)*?\*/\s*|</script>|#m', '', $ttt);
		$ttt = str_replace('<script>', '<!-- script -->', $ttt);

        return $result . $ttt . PHP_EOL . '</script>' . PHP_EOL;
    }
}
