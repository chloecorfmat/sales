<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Twig_SimpleFilter;

/**
 * Class ChloeCorfmatTwigPlugin
 * @package Grav\Plugin
 */
class ChloeCorfmatTwigPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                // Uncomment following line when plugin requires Grav < 1.7
                // ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            'onTwigInitialized' => ['onTwigInitialized', 0]
        ]);
    }

    public function onTwigInitialized()
    {
        $this->grav['twig']->twig()->addFilter(
            new Twig_SimpleFilter('blockTitle', [$this, 'blockTitle'])
        );
    }

    public function blockTitle($string)
    {
        $arr = explode("%%", $string);
        $str = '';

        for ($i = 0; $i < sizeof($arr); $i++) {
            if ($i%2 == 0) {
                $str = $str.$arr[$i];
            }

            if ($i%2 == 1) {
                $str = $str.'<span class="highlighted">' . $arr[$i] . '</span>';
            }
        }
        return $str;
    }
}
