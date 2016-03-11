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
        return array (  64 => 20,  60 => 19,  56 => 17,  54 => 16,  48 => 13,  42 => 11,  36 => 9,  27 => 6,  573 => 220,  565 => 217,  562 => 216,  560 => 215,  557 => 214,  554 => 212,  552 => 211,  549 => 209,  547 => 208,  544 => 207,  541 => 206,  531 => 202,  527 => 201,  522 => 199,  518 => 198,  514 => 197,  511 => 196,  506 => 195,  504 => 194,  501 => 193,  497 => 191,  487 => 188,  483 => 187,  478 => 185,  474 => 184,  470 => 183,  467 => 182,  462 => 181,  460 => 180,  457 => 179,  450 => 175,  446 => 174,  441 => 172,  436 => 170,  433 => 169,  431 => 168,  428 => 167,  421 => 163,  417 => 162,  412 => 160,  407 => 158,  404 => 157,  402 => 156,  399 => 155,  391 => 152,  385 => 151,  382 => 150,  380 => 149,  377 => 148,  374 => 147,  367 => 142,  363 => 141,  356 => 136,  350 => 135,  343 => 131,  336 => 129,  333 => 128,  327 => 127,  325 => 126,  321 => 124,  316 => 122,  310 => 119,  297 => 117,  293 => 116,  289 => 115,  285 => 113,  283 => 112,  280 => 111,  277 => 110,  272 => 109,  270 => 108,  264 => 105,  260 => 104,  256 => 103,  251 => 101,  247 => 100,  244 => 99,  242 => 98,  239 => 97,  232 => 93,  228 => 92,  222 => 91,  219 => 90,  217 => 89,  214 => 88,  207 => 84,  203 => 83,  197 => 82,  194 => 81,  192 => 80,  186 => 77,  182 => 76,  179 => 75,  176 => 74,  169 => 72,  166 => 71,  164 => 70,  160 => 69,  156 => 68,  150 => 67,  146 => 65,  139 => 61,  135 => 59,  132 => 58,  129 => 57,  125 => 55,  122 => 54,  119 => 53,  117 => 52,  113 => 50,  107 => 48,  105 => 47,  101 => 45,  98 => 44,  95 => 38,  92 => 37,  85 => 33,  78 => 29,  71 => 24,  69 => 25,  62 => 21,  57 => 18,  52 => 15,  49 => 11,  46 => 10,  34 => 8,  30 => 4,  51 => 15,  41 => 11,  33 => 9,  26 => 3,  21 => 2,  47 => 14,  44 => 9,  37 => 7,  31 => 5,  29 => 7,  24 => 3,  22 => 2,  19 => 1,);
    }
}
