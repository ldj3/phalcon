<?php
/**
 * View Interface
 *
 * @author Andres Gutierrez <andres@phalconphp.com>
 * @author Eduar Carvajal <eduar@phalconphp.com>
 * @version 1.2.6
 * @package Phalcon
*/
namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\ViewInterface initializer
 *
 * @see https://github.com/phalcon/cphalcon/blob/1.2.6/ext/mvc/viewinterface.c
 */
interface ViewInterface
{
    /**
     * Sets views directory. Depending of your platform, always add a trailing slash or backslash
     *
     * @param string $viewsDir
     */
    public function setViewsDir($viewsDir);

    /**
     * Gets views directory
     *
     * @return string
     */
    public function getViewsDir();

    /**
     * Sets the layouts sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
     *
     * @param string $layoutsDir
     */
    public function setLayoutsDir($layoutsDir);

    /**
     * Gets the current layouts sub-directory
     *
     * @return string
     */
    public function getLayoutsDir();

    /**
     * Sets a partials sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
     *
     * @param string $partialsDir
     */
    public function setPartialsDir($partialsDir);

    /**
     * Gets the current partials sub-directory
     *
     * @return string
     */
    public function getPartialsDir();

    /**
     * Sets base path. Depending of your platform, always add a trailing slash or backslash
     *
     * @param string $basePath
     */
    public function setBasePath($basePath);

    /**
     * Sets the render level for the view
     *
     * @param string $level
     */
    public function setRenderLevel($level);

    /**
     * Sets default view name. Must be a file without extension in the views directory
     *
     * @param string $viewPath
     */
    public function setMainView($viewPath);

    /**
     * Returns the name of the main view
     *
     * @return string
     */
    public function getMainView();

    /**
     * Change the layout to be used instead of using the name of the latest controller name
     *
     * @param string $layout
     */
    public function setLayout($layout);

    /**
     * Returns the name of the main view
     *
     * @return string
     */
    public function getLayout();

    /**
     * Appends template before controller layout
     *
     * @param string|array $templateBefore
     */
    public function setTemplateBefore($templateBefore);

    /**
     * Resets any template before layouts
     *
     */
    public function cleanTemplateBefore();

    /**
     * Appends template after controller layout
     *
     * @param string|array $templateAfter
     */
    public function setTemplateAfter($templateAfter);

    /**
     * Resets any template before layouts
     *
     */
    public function cleanTemplateAfter();

    /**
     * Adds parameters to views (alias of setVar)
     *
     * @param string $key
     * @param mixed $value
     */
    public function setParamToView($key, $value);

    /**
     * Adds parameters to views
     *
     * @param string $key
     * @param mixed $value
     */
    public function setVar($key, $value);

    /**
     * Returns parameters to views
     *
     * @return array
     */
    public function getParamsToView();

    /**
     * Gets the name of the controller rendered
     *
     * @return string
     */
    public function getControllerName();

    /**
     * Gets the name of the action rendered
     *
     * @return string
     */
    public function getActionName();

    /**
     * Gets extra parameters of the action rendered
     *
     * @return array
     */
    public function getParams();

    /**
     * Starts rendering process enabling the output buffering
     */
    public function start();

    /**
     * Register templating engines
     *
     * @param array $engines
     */
    public function registerEngines($engines);

    /**
     * Executes render process from dispatching data
     *
     * @param string $controllerName
     * @param string $actionName
     * @param array|null $params
     */
    public function render($controllerName, $actionName, $params = null);

    /**
     * Choose a view different to render than last-controller/last-action
     *
     * @param string $renderView
     */
    public function pick($renderView);

    /**
     * Renders a partial view
     *
     * @param string $partialPath
     * @return string
     */
    public function partial($partialPath);

    /**
     * Finishes the render process by stopping the output buffering
     */
    public function finish();

    /**
     * Returns the cache instance used to cache
     *
     * @return \Phalcon\Cache\BackendInterface
     */
    public function getCache();

    /**
     * Cache the actual view render to certain level
     *
     * @param boolean|array|null $options
     */
    public function cache($options = null);

    /**
     * Externally sets the view content
     *
     * @param string $content
     */
    public function setContent($content);

    /**
     * Returns cached ouput from another view stage
     *
     * @return string
     */
    public function getContent();

    /**
     * Returns the path of the view that is currently rendered
     *
     * @return string
     */
    public function getActiveRenderPath();

    /**
     * Disables the auto-rendering process
     *
     */
    public function disable();

    /**
     * Enables the auto-rendering process
     *
     */
    public function enable();

    /**
     * Resets the view component to its factory default values
     *
     */
    public function reset();
}
