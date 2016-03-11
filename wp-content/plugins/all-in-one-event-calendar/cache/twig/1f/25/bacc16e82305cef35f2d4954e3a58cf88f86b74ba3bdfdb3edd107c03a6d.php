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
        if ((!array_key_exists("hide_toolbar", $context))) {
            // line 2
            echo "\t";
            if (array_key_exists("ai1ec_before_filter_menu", $context)) {
                // line 3
                echo "\t\t";
                echo (isset($context["ai1ec_before_filter_menu"]) ? $context["ai1ec_before_filter_menu"] : null);
                echo "
\t";
            }
            // line 5
            echo "\t<div class=\"timely ai1ec-calendar-toolbar ai1ec-clearfix
\t";
            // line 6
            if (((((twig_test_empty((isset($context["categories"]) ? $context["categories"] : null)) && twig_test_empty((isset($context["tags"]) ? $context["tags"] : null))) && (!array_key_exists("additional_filters", $context))) && twig_test_empty((isset($context["contribution_buttons"]) ? $context["contribution_buttons"] : null))) && (!array_key_exists("additional_buttons", $context)))) {
                // line 12
                echo "\t\tai1ec-hidden
\t";
            }
            // line 14
            echo "\t\">
\t\t<ul class=\"ai1ec-nav ai1ec-nav-pills ai1ec-pull-left ai1ec-filters\">
\t\t\t";
            // line 16
            echo (isset($context["categories"]) ? $context["categories"] : null);
            echo "
\t\t\t";
            // line 17
            echo (isset($context["tags"]) ? $context["tags"] : null);
            echo "
\t\t\t";
            // line 18
            if (array_key_exists("additional_filters", $context)) {
                // line 19
                echo "\t\t\t\t";
                echo (isset($context["additional_filters"]) ? $context["additional_filters"] : null);
                echo "
\t\t\t";
            }
            // line 21
            echo "\t\t</ul>
\t\t<div class=\"ai1ec-pull-right\">
\t\t";
            // line 23
            if (array_key_exists("additional_buttons", $context)) {
                // line 24
                echo "\t\t\t";
                echo (isset($context["additional_buttons"]) ? $context["additional_buttons"] : null);
                echo "
\t\t";
            }
            // line 26
            echo "\t\t</div>
\t</div>";
        }
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
        return array (  33 => 6,  91 => 28,  89 => 27,  85 => 26,  80 => 25,  74 => 23,  72 => 22,  64 => 19,  57 => 17,  46 => 12,  32 => 7,  316 => 117,  312 => 115,  308 => 114,  306 => 113,  298 => 111,  291 => 110,  289 => 109,  279 => 105,  273 => 102,  268 => 100,  263 => 97,  260 => 96,  254 => 93,  249 => 91,  244 => 88,  241 => 87,  238 => 86,  236 => 85,  230 => 82,  226 => 81,  222 => 79,  217 => 77,  213 => 76,  208 => 73,  206 => 72,  197 => 67,  191 => 64,  187 => 63,  166 => 53,  156 => 48,  151 => 47,  148 => 46,  146 => 45,  142 => 44,  134 => 41,  129 => 39,  125 => 38,  114 => 30,  103 => 28,  99 => 27,  95 => 30,  92 => 25,  87 => 24,  83 => 23,  79 => 21,  71 => 26,  67 => 17,  63 => 23,  55 => 14,  51 => 18,  36 => 8,  30 => 5,  52 => 12,  47 => 17,  41 => 10,  35 => 12,  60 => 13,  48 => 8,  40 => 9,  29 => 9,  22 => 2,  28 => 5,  24 => 3,  196 => 77,  188 => 72,  184 => 62,  182 => 61,  173 => 58,  168 => 61,  162 => 51,  159 => 59,  157 => 58,  150 => 54,  145 => 52,  139 => 43,  131 => 40,  126 => 44,  120 => 43,  112 => 36,  107 => 29,  101 => 32,  93 => 30,  88 => 28,  82 => 27,  73 => 19,  68 => 20,  65 => 24,  59 => 21,  53 => 19,  44 => 11,  42 => 11,  34 => 5,  27 => 5,  25 => 4,  23 => 3,  86 => 26,  75 => 24,  70 => 19,  66 => 14,  62 => 18,  58 => 14,  54 => 11,  50 => 11,  43 => 16,  39 => 14,  31 => 5,  26 => 3,  21 => 2,  19 => 1,);
    }
}
