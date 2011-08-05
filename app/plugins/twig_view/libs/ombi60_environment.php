<?php

class Ombi60_Twig_Environment extends Twig_Environment
{
    protected $themeFolder;
    protected $theme;

    /**
     * Available options:
     *  * theme
     *  * theme_folder
     *
     * {@inheritDoc}
     */
    public function __construct(Twig_LoaderInterface $loader = null, $options = array())
    {
        if (isset($options['theme'])) {
            $this->themeFolder = $options['theme_folder'];
            $this->theme       = $options['theme'];

            unset($options['theme'], $options['theme_folder']);
        }

        parent::__construct($loader, $options);
    }

    /**
     * {@inheritDoc}
     */
    public function loadTemplate($name)
    {
        if (preg_match('#^/?'.preg_quote($this->themeFolder).'/(.*)$#', $name, $match)) {
            if (!preg_match('#^'.preg_quote($this->theme).'#', $match[1])) {
                throw new InvalidArgumentException(sprintf('The template "%s" cannot be included for the theme "%s"', $name, $this->theme));
            }
        }

        return parent::loadTemplate($name);
    }
}