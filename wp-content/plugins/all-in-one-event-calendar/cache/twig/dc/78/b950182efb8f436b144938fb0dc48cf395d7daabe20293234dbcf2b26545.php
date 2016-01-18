<?php

/* recurrence.twig */
class __TwigTemplate_dc78b950182efb8f436b144938fb0dc48cf395d7daabe20293234dbcf2b26545 extends Twig_Template
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
        if ((!twig_test_empty((isset($context["recurrence"]) ? $context["recurrence"] : null)))) {
            // line 2
            echo "\t<div class=\"ai1ec-recurrence ai1ec-btn-group\">
\t\t<button class=\"ai1ec-btn ai1ec-btn-default ai1ec-btn-xs
\t\t\tai1ec-tooltip-trigger ai1ec-disabled ai1ec-text-muted\"
\t\t\tdata-html=\"true\"
\t\t\ttitle=\"";
            // line 6
            ob_start();
            // line 7
            echo "\t\t\t\t";
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, (isset($context["recurrence"]) ? $context["recurrence"] : null)), "html_attr");
            echo "
\t\t\t\t";
            // line 8
            if ((!twig_test_empty((isset($context["exclude"]) ? $context["exclude"] : null)))) {
                // line 9
                echo "\t\t\t\t\t";
                echo twig_escape_filter($this->env, ((("<div class=\"ai1ec-recurrence-exclude\">" . Ai1ec_I18n::__("Excludes: ")) . (isset($context["exclude"]) ? $context["exclude"] : null)) . "</div>"), "html_attr");
                echo "
\t\t\t\t";
            }
            // line 11
            echo "\t\t\t";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            echo "\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-repeat\"></i>
\t\t\t";
            // line 13
            echo twig_escape_filter($this->env, Ai1ec_I18n::__("Repeats"), "html", null, true);
            echo "
\t\t</button>

\t\t";
            // line 16
            if ((!twig_test_empty((isset($context["edit_instance_url"]) ? $context["edit_instance_url"] : null)))) {
                // line 17
                echo "\t\t\t<a class=\"ai1ec-btn ai1ec-btn-default ai1ec-btn-xs ai1ec-tooltip-trigger
\t\t\t\tai1ec-text-muted\"
\t\t\t\ttitle=\"";
                // line 19
                echo twig_escape_filter($this->env, (isset($context["edit_instance_text"]) ? $context["edit_instance_text"] : null), "html_attr");
                echo "\"
\t\t\t\thref=\"";
                // line 20
                echo twig_escape_filter($this->env, (isset($context["edit_instance_url"]) ? $context["edit_instance_url"] : null), "html", null, true);
                echo "\">
\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-pencil\"></i>
\t\t\t</a>
\t\t";
            }
            // line 24
            echo "\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "recurrence.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 24,  64 => 20,  60 => 19,  56 => 17,  54 => 16,  48 => 13,  42 => 11,  36 => 9,  27 => 6,  376 => 149,  371 => 146,  368 => 142,  365 => 141,  363 => 140,  360 => 139,  357 => 137,  355 => 136,  352 => 134,  350 => 133,  347 => 132,  343 => 130,  333 => 127,  329 => 126,  324 => 124,  320 => 123,  316 => 122,  313 => 121,  308 => 120,  306 => 119,  303 => 118,  296 => 114,  292 => 113,  287 => 111,  282 => 109,  279 => 108,  277 => 107,  274 => 106,  267 => 102,  263 => 101,  258 => 99,  253 => 97,  250 => 96,  248 => 95,  245 => 94,  237 => 91,  231 => 90,  228 => 89,  226 => 88,  223 => 87,  216 => 83,  212 => 82,  206 => 81,  203 => 80,  201 => 79,  198 => 78,  191 => 74,  187 => 73,  181 => 72,  178 => 71,  176 => 70,  170 => 67,  166 => 66,  163 => 65,  160 => 64,  153 => 62,  150 => 61,  148 => 60,  144 => 59,  140 => 58,  134 => 57,  130 => 55,  123 => 51,  119 => 49,  116 => 48,  113 => 47,  109 => 45,  106 => 44,  103 => 43,  101 => 42,  97 => 40,  91 => 38,  89 => 37,  85 => 35,  82 => 34,  79 => 28,  76 => 27,  69 => 23,  62 => 19,  55 => 16,  53 => 15,  46 => 11,  34 => 8,  30 => 4,  51 => 15,  41 => 11,  33 => 9,  26 => 3,  21 => 2,  47 => 14,  44 => 11,  37 => 7,  31 => 5,  29 => 7,  24 => 3,  22 => 2,  19 => 1,);
    }
}
