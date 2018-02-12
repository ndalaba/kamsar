<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */
return array(
    /**
     * base_url - The base URL of the application.
     * MUST contain a trailing slash (/)
     *
     * You can set this to a full or relative URL:
     *
     *     'base_url' => '/foo/',
     *     'base_url' => 'http://foo.com/'
     *
     * Set this to null to have it automatically detected.
     */
    'base_url' => 'http://kamsar.development-in.com/',
    /**
     * url_suffix - Any suffix that needs to be added to
     * URL's generated by Fuel. If the suffix is an extension,
     * make sure to include the dot
     *
     *     'url_suffix' => '.html',
     *
     * Set this to an empty string if no suffix is used
     */
    'url_suffix' => '',
    /**
     * index_file - The name of the main bootstrap file.
     *
     * Set this to false or remove if you using mod_rewrite.
     */
    'index_file' => '',
    'profiling' => false,
    /**
     * Default location for the file cache
     */
    'cache_dir' => APPPATH . 'cache/',
    /**
     * Settings for the file finder cache (the Cache class has it's own config!)
     */
    'caching' => false,
    'cache_lifetime' => 3600, // In Seconds

    /**
     * Callback to use with ob_start(), set this to 'ob_gzhandler' for gzip encoding of output
     */
    'ob_callback' => null,
    'errors' => array(
        // Which errors should we show, but continue execution? You can add the following:
        // E_NOTICE, E_WARNING, E_DEPRECATED, E_STRICT to mimic PHP's default behaviour
        // (which is to continue on non-fatal errors). We consider this bad practice.
        'continue_on' => array(),
        // How many errors should we show before we stop showing them? (prevents out-of-memory errors)
        'throttle' => 10,
        // Should notices from Error::notice() be shown?
        'notices' => true,
    ),
    /**
     * Localization & internationalization settings
     */
    'language' => 'en', // Default language
    'language_fallback' => 'en', // Fallback language when file isn't available for default language
    'locale' => 'en_US', // PHP set_locale() setting, null to not set
    'encoding' => 'UTF-8',
    /**
     * DateTime settings
     *
     * server_gmt_offset	in seconds the server offset from gmt timestamp when time() is used
     * default_timezone		optional, if you want to change the server's default timezone
     */
    'server_gmt_offset' => 0,
    'default_timezone' => 'UTC',
    /**
     * Logging Threshold.  Can be set to any of the following:
     *
     * Fuel::L_NONE
     * Fuel::L_ERROR
     * Fuel::L_WARNING
     * Fuel::L_DEBUG
     * Fuel::L_INFO
     * Fuel::L_ALL
     */
    'log_threshold' => Fuel::L_WARNING,
    'log_path' => APPPATH . 'logs/',
    'log_date_format' => 'Y-m-d H:i:s',
    /**
     * Security settings
     */
    'security' => array(
        'csrf_autoload' => false,
        'csrf_token_key' => 'fuel_csrf_token',
        'csrf_expiration' => 0,
        'uri_filter' => array('htmlentities'),
        /**
         * This input filter can be any normal PHP function as well as 'xss_clean'
         *
         * WARNING: Using xss_clean will cause a performance hit.
         * How much is dependant on how much input data there is.
         */
        'input_filter' => array(),
        /**
         * This output filter can be any normal PHP function as well as 'xss_clean'
         *
         * WARNING: Using xss_clean will cause a performance hit.
         * How much is dependant on how much input data there is.
         */
        'output_filter' => array('Security::htmlentities'),
        /**
         * Whether to automatically filter view data
         */
        'auto_filter_output' => false,
        /**
         * With output encoding switched on all objects passed will be converted to strings or
         * throw exceptions unless they are instances of the classes in this array.
         */
        'whitelisted_classes' => array(
            'Fuel\\Core\\Response',
            'Fuel\\Core\\View',
            'Fuel\\Core\\ViewModel',
            'Closure',
        )
    ),
    /**
     * Cookie settings
     */
    'cookie' => array(
        // Number of seconds before the cookie expires
        'expiration' => 0,
        // Restrict the path that the cookie is available to
        'path' => '/',
        // Restrict the domain that the cookie is available to
        'domain' => null,
        // Only transmit cookies over secure connections
        'secure' => false,
        // Only transmit cookies over HTTP, disabling Javascript access
        'http_only' => false,
    ),
    /**
     * Validation settings
     */
    'validation' => array(
        /**
         * Wether to fallback to global when a value is not found in the input array.
         */
        'global_input_fallback' => true,
    ),
    /**
     * Routing settings
     */
    'routing' => array(
        /**
         * Whether URI routing is case sensitive or not
         */
        'case_sensitive' => true,
    ),
    /**
     * To enable you to split up your application into modules which can be
     * routed by the first uri segment you have to define their basepaths
     * here. By default empty, but to use them you can add something
     * like this:
     *      array(APPPATH.'modules'.DS)
     *
     * Paths MUST end with a directory separator (the DS constant)!
     */
    'module_paths' => array(
    //APPPATH.'modules'.DS
    ),
    /**
     * To enable you to split up your additions to the framework, packages are
     * used. You can define the basepaths for your packages here. By default
     * empty, but to use them you can add something like this:
     *      array(APPPATH.'modules'.DS)
     *
     * Paths MUST end with a directory separator (the DS constant)!
     */
    'package_paths' => array(
    //PKGPATH
    ),
    /*     * *********************************************************************** */
    /* Always Load                                                            */
    /*     * *********************************************************************** */
    'always_load' => array(
        /**
         * These packages are loaded on Fuel's startup.
         * You can specify them in the following manner:
         *
         * array('auth'); // This will assume the packages are in PKGPATH
         *
         * // Use this format to specify the path to the package explicitly
         * array(
         *     array('auth'	=> PKGPATH.'auth/')
         * );
         */
        'packages' => array(
            'orm','email'
        ),
        /**
         * These modules are always loaded on Fuel's startup. You can specify them
         * in the following manner:
         *
         * array('module_name');
         *
         * A path must be set in module_paths for this to work.
         */
        'modules' => array(),
        /**
         * Classes to autoload & initialize even when not used
         */
        'classes' => array(),
        /**
         * Configs to autoload
         *
         * Examples: if you want to load 'session' config into a group 'session' you only have to
         * add 'session'. If you want to add it to another group (example: 'auth') you have to
         * add it like 'session' => 'auth'.
         * If you don't want the config in a group use null as groupname.
         */
        'config' => array(),
        /**
         * Language files to autoload
         *
         * Examples: if you want to load 'validation' lang into a group 'validation' you only have to
         * add 'validation'. If you want to add it to another group (example: 'forms') you have to
         * add it like 'validation' => 'forms'.
         * If you don't want the lang in a group use null as groupname.
         */
        'language' => array(),
    ),
);