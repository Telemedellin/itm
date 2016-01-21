<?php

/* setting/calendar-page-selector.twig */
class __TwigTemplate_6e01f7b633075695c9bd632326ff59da1a8f98dcfec6a6bbfbc28b12c0bc45d1 extends Twig_Template
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
        echo "<p><a target=\"_blank\" href=\"";
        echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : null), "html", null, true);
        echo "\">
  ";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["view"]) ? $context["view"] : null), "html", null, true);
        echo " \"";
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "\"
  <i class=\"ai1ec-fa ai1ec-fa-arrow-right\"></i>
</a></p>
";
    }

    public function getTemplateName()
    {
        return "setting/calendar-page-selector.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 2,  19 => 1,  51 => 8,  47 => 12,  41 => 8,  36 => 6,  32 => 5,  27 => 3,  23 => 2,  20 => 1,  56 => 13,  52 => 11,  46 => 8,  43 => 9,  40 => 6,  38 => 5,  34 => 4,  31 => 3,  28 => 2,);
    }
}
