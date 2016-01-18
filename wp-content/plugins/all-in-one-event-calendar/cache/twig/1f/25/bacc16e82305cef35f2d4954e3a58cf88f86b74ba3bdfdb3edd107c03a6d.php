<?php

/* filter-menu.twig */
class __TwigTemplate_1f25bacc16e82305cef35f2d4954e3a58cf88f86b74ba3bdfdb3edd107c03a6d extends Twig_Template
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
        if (array_key_exists("ai1ec_before_filter_menu", $context)) {
            // line 2
            echo "\t";
            echo (isset($context["ai1ec_before_filter_menu"]) ? $context["ai1ec_before_filter_menu"] : null);
            echo "
";
        }
        // line 4
        echo "<div class=\"timely ai1ec-calendar-toolbar ai1ec-clearfix
";
        // line 5
        if (((((twig_test_empty((isset($context["categories"]) ? $context["categories"] : null)) && twig_test_empty((isset($context["tags"]) ? $context["tags"] : null))) && (!array_key_exists("additional_filters", $context))) && twig_test_empty((isset($context["contribution_buttons"]) ? $context["contribution_buttons"] : null))) && (!array_key_exists("additional_buttons", $context)))) {
            // line 11
            echo "\tai1ec-hidden
";
        }
        // line 13
        echo "\t\">
\t<ul class=\"ai1ec-nav ai1ec-nav-pills ai1ec-pull-left ai1ec-filters\">
\t\t";
        // line 15
        echo (isset($context["categories"]) ? $context["categories"] : null);
        echo "
\t\t";
        // line 16
        echo (isset($context["tags"]) ? $context["tags"] : null);
        echo "
\t\t";
        // line 17
        if (array_key_exists("additional_filters", $context)) {
            // line 18
            echo "\t\t\t";
            echo (isset($context["additional_filters"]) ? $context["additional_filters"] : null);
            echo "
\t\t";
        }
        // line 20
        echo "\t</ul>
\t<div class=\"ai1ec-pull-right\">
\t";
        // line 22
        if (array_key_exists("additional_buttons", $context)) {
            // line 23
            echo "\t\t";
            echo (isset($context["additional_buttons"]) ? $context["additional_buttons"] : null);
            echo "
\t";
        }
        // line 25
        echo "\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "filter-menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 20,  91 => 28,  89 => 27,  85 => 26,  80 => 25,  74 => 23,  72 => 22,  64 => 19,  57 => 17,  46 => 12,  32 => 11,  316 => 117,  312 => 115,  308 => 114,  306 => 113,  298 => 111,  291 => 110,  289 => 109,  279 => 105,  273 => 102,  268 => 100,  263 => 97,  260 => 96,  254 => 93,  249 => 91,  244 => 88,  241 => 87,  238 => 86,  236 => 85,  230 => 82,  226 => 81,  222 => 79,  217 => 77,  213 => 76,  208 => 73,  206 => 72,  197 => 67,  191 => 64,  187 => 63,  166 => 53,  156 => 48,  151 => 47,  148 => 46,  146 => 45,  142 => 44,  134 => 41,  129 => 39,  125 => 38,  114 => 30,  103 => 28,  99 => 27,  95 => 30,  92 => 25,  87 => 24,  83 => 23,  79 => 21,  71 => 18,  67 => 17,  63 => 16,  55 => 14,  51 => 13,  36 => 13,  30 => 5,  52 => 12,  47 => 10,  41 => 10,  35 => 6,  60 => 22,  48 => 17,  40 => 15,  29 => 9,  22 => 2,  28 => 5,  24 => 4,  196 => 77,  188 => 72,  184 => 62,  182 => 61,  173 => 58,  168 => 61,  162 => 51,  159 => 59,  157 => 58,  150 => 54,  145 => 52,  139 => 43,  131 => 40,  126 => 44,  120 => 43,  112 => 36,  107 => 29,  101 => 32,  93 => 30,  88 => 28,  82 => 27,  73 => 19,  68 => 25,  65 => 19,  59 => 15,  53 => 16,  44 => 16,  42 => 11,  34 => 5,  27 => 4,  25 => 4,  23 => 3,  86 => 26,  75 => 24,  70 => 19,  66 => 14,  62 => 23,  58 => 14,  54 => 11,  50 => 18,  43 => 13,  39 => 7,  31 => 5,  26 => 3,  21 => 2,  19 => 1,);
    }
}
