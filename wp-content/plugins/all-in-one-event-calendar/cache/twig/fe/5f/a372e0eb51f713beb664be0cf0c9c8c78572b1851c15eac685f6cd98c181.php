<?php

/* calendar.twig */
class __TwigTemplate_fe5fa372e0eb51f713beb664be0cf0c9c8c78572b1851c15eac685f6cd98c181 extends Twig_Template
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
        // line 2
        echo "<!-- START All-in-One Event Calendar Plugin - Version ";
        echo (isset($context["version"]) ? $context["version"] : null);
        echo " -->
<div id=\"ai1ec-container\"
\t class=\"ai1ec-main-container ";
        // line 4
        echo (isset($context["ai1ec_calendar_classes"]) ? $context["ai1ec_calendar_classes"] : null);
        echo "\">
\t<!-- AI1EC_PAGE_CONTENT_PLACEHOLDER -->
\t<div id=\"ai1ec-calendar\" class=\"timely ai1ec-calendar\">
\t\t";
        // line 7
        if (array_key_exists("ai1ec_above_calendar", $context)) {
            // line 8
            echo "\t\t\t";
            echo (isset($context["ai1ec_above_calendar"]) ? $context["ai1ec_above_calendar"] : null);
            echo "
\t\t";
        }
        // line 10
        echo "\t\t";
        echo (isset($context["filter_menu"]) ? $context["filter_menu"] : null);
        echo "
\t\t<div id=\"ai1ec-calendar-view-container\"
\t\t\t class=\"ai1ec-calendar-view-container\">
\t\t\t<div id=\"ai1ec-calendar-view-loading\"
\t\t\t\t class=\"ai1ec-loading ai1ec-calendar-view-loading\"></div>
\t\t\t<div id=\"ai1ec-calendar-view\" class=\"ai1ec-calendar-view\">
\t\t\t\t";
        // line 16
        echo (isset($context["view"]) ? $context["view"] : null);
        echo "
\t\t\t</div>
\t\t</div>
\t\t<div class=\"ai1ec-subscribe-container ai1ec-pull-right ai1ec-btn-group\">
\t\t\t";
        // line 20
        echo (isset($context["subscribe_buttons"]) ? $context["subscribe_buttons"] : null);
        echo "
\t\t</div>
\t\t";
        // line 22
        echo (isset($context["after_view"]) ? $context["after_view"] : null);
        echo "
\t</div><!-- /.timely -->
</div>
";
        // line 25
        if ((!twig_test_empty((isset($context["inline_js_calendar"]) ? $context["inline_js_calendar"] : null)))) {
            // line 26
            echo "\t<script type=\"text/javascript\">";
            echo (isset($context["inline_js_calendar"]) ? $context["inline_js_calendar"] : null);
            echo "</script>
";
        }
        // line 28
        echo "<!-- END All-in-One Event Calendar Plugin -->
";
        // line 30
        echo "

";
    }

    public function getTemplateName()
    {
        return "calendar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 30,  69 => 26,  61 => 22,  49 => 16,  33 => 8,  56 => 20,  91 => 28,  89 => 27,  85 => 26,  80 => 25,  74 => 23,  72 => 22,  64 => 19,  57 => 17,  46 => 12,  32 => 11,  316 => 117,  312 => 115,  308 => 114,  306 => 113,  298 => 111,  291 => 110,  289 => 109,  279 => 105,  273 => 102,  268 => 100,  263 => 97,  260 => 96,  254 => 93,  249 => 91,  244 => 88,  241 => 87,  238 => 86,  236 => 85,  230 => 82,  226 => 81,  222 => 79,  217 => 77,  213 => 76,  208 => 73,  206 => 72,  197 => 67,  191 => 64,  187 => 63,  166 => 53,  156 => 48,  151 => 47,  148 => 46,  146 => 45,  142 => 44,  134 => 41,  129 => 39,  125 => 38,  114 => 30,  103 => 28,  99 => 27,  95 => 30,  92 => 25,  87 => 24,  83 => 23,  79 => 21,  71 => 18,  67 => 25,  63 => 16,  55 => 14,  51 => 13,  36 => 13,  30 => 5,  52 => 12,  47 => 10,  41 => 10,  35 => 6,  60 => 22,  48 => 17,  40 => 15,  29 => 9,  22 => 2,  28 => 5,  24 => 4,  196 => 77,  188 => 72,  184 => 62,  182 => 61,  173 => 58,  168 => 61,  162 => 51,  159 => 59,  157 => 58,  150 => 54,  145 => 52,  139 => 43,  131 => 40,  126 => 44,  120 => 43,  112 => 36,  107 => 29,  101 => 32,  93 => 30,  88 => 28,  82 => 27,  73 => 19,  68 => 25,  65 => 19,  59 => 15,  53 => 16,  44 => 16,  42 => 11,  34 => 5,  27 => 4,  25 => 4,  23 => 3,  86 => 26,  75 => 28,  70 => 19,  66 => 14,  62 => 23,  58 => 14,  54 => 11,  50 => 18,  43 => 13,  39 => 10,  31 => 7,  26 => 3,  21 => 2,  19 => 2,);
    }
}
