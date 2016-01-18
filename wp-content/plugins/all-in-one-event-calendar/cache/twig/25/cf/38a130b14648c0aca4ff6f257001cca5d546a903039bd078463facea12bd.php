<?php

/* week.twig */
class __TwigTemplate_25cf38a130b14648c0aca4ff6f257001cca5d546a903039bd078463facea12bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->env->loadTemplate("oneday.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "week.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
