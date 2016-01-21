<?php

/* setting/tags-categories.twig */
class __TwigTemplate_a845b81d2c33eedd005263926a03c59262ab19f88a1b32214b021315fba4a629 extends Twig_Template
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
        echo "<div class=\"ai1ec-default-filters ai1ec-form-group\">
\t<label class=\"ai1ec-control-label ai1ec-col-sm-3\">
\t\t";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
        echo "
\t\t<div class=\"ai1ec-help-block\">
\t\t";
        // line 5
        echo (isset($context["help"]) ? $context["help"] : null);
        echo "
\t\t</div>
\t</label>
\t<div class=\"ai1ec-col-sm-9\">
\t\t<div class=\"ai1ec-row\">
\t\t\t";
        // line 10
        if (array_key_exists("categories", $context)) {
            // line 11
            echo "\t\t\t\t<div class=\"ai1ec-col-md-6\">
\t\t\t\t\t";
            // line 12
            echo (isset($context["categories"]) ? $context["categories"] : null);
            echo "
\t\t\t\t</div>
\t\t\t";
        }
        // line 15
        echo "\t\t\t";
        if (array_key_exists("tags", $context)) {
            // line 16
            echo "\t\t\t\t<div class=\"ai1ec-col-md-6\">
\t\t\t\t\t";
            // line 17
            echo (isset($context["tags"]) ? $context["tags"] : null);
            echo "
\t\t\t\t</div>
\t\t\t";
        }
        // line 20
        echo "\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "setting/tags-categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 17,  50 => 16,  36 => 10,  28 => 5,  23 => 3,  163 => 31,  152 => 29,  148 => 28,  144 => 27,  140 => 26,  136 => 25,  133 => 24,  127 => 22,  124 => 21,  109 => 20,  76 => 12,  45 => 4,  42 => 3,  97 => 17,  91 => 16,  88 => 32,  81 => 27,  77 => 26,  73 => 24,  71 => 11,  67 => 10,  60 => 18,  58 => 17,  48 => 5,  46 => 12,  39 => 2,  31 => 5,  29 => 4,  24 => 1,  168 => 36,  162 => 35,  156 => 33,  145 => 31,  141 => 30,  137 => 29,  134 => 28,  130 => 23,  121 => 24,  110 => 22,  106 => 21,  102 => 20,  99 => 19,  95 => 35,  90 => 17,  87 => 16,  83 => 14,  80 => 13,  74 => 13,  66 => 11,  63 => 9,  59 => 20,  55 => 7,  47 => 15,  44 => 5,  38 => 11,  21 => 1,  56 => 11,  51 => 6,  49 => 9,  43 => 11,  35 => 2,  30 => 3,  41 => 12,  34 => 6,  26 => 2,  22 => 2,  19 => 1,);
    }
}
