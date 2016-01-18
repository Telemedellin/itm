<?php

/* categories.twig */
class __TwigTemplate_b5633d95de14839f5641ad75e89a427aa6fdfc24b529c6a3f1d8e24779f6f79f extends Twig_Template
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
        echo "<li class=\"ai1ec-dropdown ai1ec-category-filter ai1ec-cat-filter
\t";
        // line 2
        if ((!twig_test_empty((isset($context["selected_cat_ids"]) ? $context["selected_cat_ids"] : null)))) {
            echo "ai1ec-active";
        }
        echo "\"
\tdata-slug=\"cat\">
\t<a class=\"ai1ec-dropdown-toggle\" data-toggle=\"ai1ec-dropdown\">
\t\t<i class=\"ai1ec-fa ai1ec-fa-folder-open\"></i>
\t\t<span class=\"ai1ec-clear-filter ai1ec-tooltip-trigger\"
\t\t\tdata-href=\"";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["clear_filter"]) ? $context["clear_filter"] : null), "html", null, true);
        echo "\"
\t\t\t";
        // line 8
        echo (isset($context["data_type"]) ? $context["data_type"] : null);
        echo "
\t\t\ttitle=\"";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["text_clear_category_filter"]) ? $context["text_clear_category_filter"] : null), "html", null, true);
        echo "\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-times-circle\"></i>
\t\t</span>
\t\t";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["text_categories"]) ? $context["text_categories"] : null), "html", null, true);
        echo "
\t\t<span class=\"ai1ec-caret\"></span>
\t</a>
\t<div class=\"ai1ec-dropdown-menu\">
\t\t";
        // line 16
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["term"]) {
            // line 17
            echo "\t\t\t<div data-term=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["term"]) ? $context["term"] : null), "term_id"), "html", null, true);
            echo "\"
\t\t\t\t";
            // line 18
            if (twig_in_filter($this->getAttribute((isset($context["term"]) ? $context["term"] : null), "term_id"), (isset($context["selected_cat_ids"]) ? $context["selected_cat_ids"] : null))) {
                // line 19
                echo "\t\t\t\t\tclass=\"ai1ec-active\"
\t\t\t\t";
            }
            // line 20
            echo ">
\t\t\t\t<a class=\"ai1ec-load-view ai1ec-category ai1ec-cat\"
\t\t\t\t\t";
            // line 22
            if ((!twig_test_empty($this->getAttribute((isset($context["term"]) ? $context["term"] : null), "description")))) {
                // line 23
                echo "\t\t\t\t\t\ttitle=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["term"]) ? $context["term"] : null), "description"), "html_attr");
                echo "\"
\t\t\t\t\t";
            }
            // line 25
            echo "\t\t\t\t\t";
            echo (isset($context["data_type"]) ? $context["data_type"] : null);
            echo "
\t\t\t\t\thref=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["term"]) ? $context["term"] : null), "href"), "html", null, true);
            echo "\">
\t\t\t\t\t";
            // line 27
            if (twig_test_empty($this->getAttribute((isset($context["term"]) ? $context["term"] : null), "color"))) {
                // line 28
                echo "\t\t\t\t\t\t<span class=\"ai1ec-color-swatch-empty\"></span>
\t\t\t\t\t";
            } else {
                // line 30
                echo "\t\t\t\t\t\t";
                echo $this->getAttribute((isset($context["term"]) ? $context["term"] : null), "color");
                echo "
\t\t\t\t\t";
            }
            // line 32
            echo "\t\t\t\t\t";
            echo $this->getAttribute((isset($context["term"]) ? $context["term"] : null), "name");
            echo "
\t\t\t\t</a>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['term'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "\t</div>
</li>

";
    }

    public function getTemplateName()
    {
        return "categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 28,  89 => 27,  85 => 26,  80 => 25,  74 => 23,  72 => 22,  64 => 19,  57 => 17,  46 => 12,  32 => 7,  316 => 117,  312 => 115,  308 => 114,  306 => 113,  298 => 111,  291 => 110,  289 => 109,  279 => 105,  273 => 102,  268 => 100,  263 => 97,  260 => 96,  254 => 93,  249 => 91,  244 => 88,  241 => 87,  238 => 86,  236 => 85,  230 => 82,  226 => 81,  222 => 79,  217 => 77,  213 => 76,  208 => 73,  206 => 72,  197 => 67,  191 => 64,  187 => 63,  166 => 53,  156 => 48,  151 => 47,  148 => 46,  146 => 45,  142 => 44,  134 => 41,  129 => 39,  125 => 38,  114 => 30,  103 => 28,  99 => 27,  95 => 30,  92 => 25,  87 => 24,  83 => 23,  79 => 21,  71 => 18,  67 => 17,  63 => 16,  55 => 14,  51 => 13,  36 => 8,  30 => 6,  52 => 12,  47 => 10,  41 => 10,  35 => 6,  60 => 13,  48 => 8,  40 => 9,  29 => 9,  22 => 2,  28 => 5,  24 => 4,  196 => 77,  188 => 72,  184 => 62,  182 => 61,  173 => 58,  168 => 61,  162 => 51,  159 => 59,  157 => 58,  150 => 54,  145 => 52,  139 => 43,  131 => 40,  126 => 44,  120 => 43,  112 => 36,  107 => 29,  101 => 32,  93 => 30,  88 => 28,  82 => 27,  73 => 19,  68 => 20,  65 => 19,  59 => 15,  53 => 16,  44 => 11,  42 => 11,  34 => 5,  27 => 5,  25 => 4,  23 => 3,  86 => 26,  75 => 24,  70 => 19,  66 => 14,  62 => 18,  58 => 14,  54 => 11,  50 => 11,  43 => 13,  39 => 7,  31 => 5,  26 => 3,  21 => 2,  19 => 1,);
    }
}
