<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Instance_Messages
 */
class Instance_Plugins extends Instance {

    protected $_menu;

    public function getMenu()
    {
        return
            $this->_menu;
    }

    public function getPlugins()
    {
        return
            Kohana::$config->load('plugins.included');
    }

    public function formPluginRoutes()
    {
        $plugins = $this->getPlugins();
        $this->_menu = array();

        foreach ($plugins as $plugin)
        {
            $controller = 'Controller_Plugin_'.$plugin;

            Route::set('a3_core_plugins', '(<lng>/)'.A3_ROOT_URL.'/'.strtolower($plugin).'(/<action>)')
                ->defaults(array(
                    'directory' => 'plugin',
                    'controller' => 'dummy',
                ));

            $routes = $controller::getMenuTree();

            if (!count($routes))
            {
                Log::instance()->add(Log::WARNING, 'Abton3 CMS :: On Instance_Plugins::formPluginRoutes() : plugin \':plugin\' doesnt provide valid menu tree!', array(
                    ':plugin' => $plugin,
                ));
                continue;
            }

            $template_array = Instance_L10n::get()->getConstantsArray('plugin/'.strtolower($plugin));

            $tree = array();
            foreach ($routes as $key => $route)
            {
                $tree[] = array(
                    'title' => $template_array[$key],
                    'href' => Instance_Routing::get()->getPrefixHref().strtolower($plugin).'/'.$route['path'],
                    'icon' => $route['icon'],
                    'action' => $route['path']
                );
            }

            $this->_menu[] = array(
                'name' => strtolower($plugin),
                'tree' => $tree
            );
        }
    }

    /*
     * Инициализация
     */
    protected function __construct()
    {
        $this->_menu = array();
    }

    // -- реализация синглтона -------------------------------------------

    /**
     * @var Instance
     */
    private static $_instance;

    final private function __clone() { }

    /*
     * @return Instance_Messages
     */
    public static function get()
    {
        // если переменная пуста...
        if (null === self::$_instance)
            // ...то создаем объект класса
        self::$_instance = new self();

        return
            self::$_instance;
    }

}