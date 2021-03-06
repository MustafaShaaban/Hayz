<?php

// autoload_real_52.php generated by xrstf/composer-php52

class ComposerAutoloaderInit2cae670f89444e144d7ec98c27e97951 {
	private static $loader;

	public static function loadClassLoader($class) {
		if ('xrstf_Composer52_ClassLoader' === $class) {
			require dirname(__FILE__).'/ClassLoader52.php';
		}
	}

	/**
	 * @return xrstf_Composer52_ClassLoader
	 */
	public static function getLoader() {
		if (null !== self::$loader) {
			return self::$loader;
		}

		spl_autoload_register(array('ComposerAutoloaderInit2cae670f89444e144d7ec98c27e97951', 'loadClassLoader'), true /*, true */);
		self::$loader = $loader = new xrstf_Composer52_ClassLoader();
		spl_autoload_unregister(array('ComposerAutoloaderInit2cae670f89444e144d7ec98c27e97951', 'loadClassLoader'));

		$vendorDir = dirname(dirname(__FILE__));
		$baseDir   = dirname($vendorDir);
		$dir       = dirname(__FILE__);

		$map = require $dir.'/autoload_namespaces.php';
		foreach ($map as $namespace => $path) {
			$loader->add($namespace, $path);
		}

		$classMap = require $dir.'/autoload_classmap.php';
		if ($classMap) {
			$loader->addClassMap($classMap);
		}

		$loader->register(true);

		require $vendorDir . '/bluehost/endurance-wp-module-business-reviews/bootstrap.php';
		require $vendorDir . '/bluehost/endurance-wp-module-gutenframe/bootstrap.php';
		require $vendorDir . '/bluehost/endurance-wp-module-loader/module-loader.php';
		require $vendorDir . '/bluehost/endurance-wp-module-spam-prevention/bootstrap.php';
		require $vendorDir . '/bluehost/endurance-wp-module-sso/bootstrap.php';

		return $loader;
	}
}
