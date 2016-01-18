<?php

/* agenda-buttons.twig */
class __TwigTemplate_e2c54407992fc7f64fc763c8fa820f4d1ef92de870acc466bbd2209e5965d014 extends Twig_Template
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
        echo "<div class=\"ai1ec-agenda-buttons ai1ec-btn-toolbar ai1ec-pull-right\">
\t<div class=\"ai1ec-btn-group ai1ec-btn-group-xs\">
\t\t<a id=\"ai1ec-print-button\" href=\"#\" class=\"ai1ec-btn ai1ec-btn-default ai1ec-btn-xs\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-print\"></i>
\t\t</a>
\t</div>
\t<div class=\"ai1ec-btn-group ai1ec-btn-group-xs\">
\t\t<a id=\"ai1ec-agenda-collapse-all\" class=\"ai1ec-btn ai1ec-btn-default ai1ec-btn-xs\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-minus-circle\"></i> ";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["text_collapse_all"]) ? $context["text_collapse_all"] : null), "html", null, true);
        echo "
\t\t</a>
\t\t<a id=\"ai1ec-agenda-expand-all\" class=\"ai1ec-btn ai1ec-btn-default ai1ec-btn-xs\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-plus-circle\"></i> ";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["text_expand_all"]) ? $context["text_expand_all"] : null), "html", null, true);
        echo "
\t\t</a>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "agenda-buttons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 12,  60 => 13,  48 => 8,  40 => 6,  29 => 9,  22 => 2,  28 => 5,  24 => 4,  196 => 77,  188 => 72,  184 => 70,  182 => 69,  173 => 63,  168 => 61,  162 => 60,  159 => 59,  157 => 58,  150 => 54,  145 => 52,  139 => 51,  131 => 46,  126 => 44,  120 => 43,  112 => 38,  107 => 36,  101 => 35,  93 => 30,  88 => 28,  82 => 27,  73 => 23,  68 => 20,  65 => 19,  59 => 17,  53 => 15,  44 => 7,  42 => 11,  34 => 5,  27 => 5,  25 => 4,  23 => 3,  86 => 26,  75 => 24,  70 => 19,  66 => 14,  62 => 17,  58 => 16,  54 => 11,  50 => 11,  43 => 13,  39 => 7,  31 => 7,  26 => 3,  21 => 2,  19 => 1,);
    }
}
