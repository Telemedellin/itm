<?php

/* setting/checkbox.twig */
class __TwigTemplate_282745a08a32adc67392b55ee4ca55b6d618501e2c61c94eaf0b8b2925984cee extends Twig_Template
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
        echo "<div class=\"ai1ec-col-sm-12\">
\t<div class=\"checkbox\">
\t\t<label for=\"";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "\">
\t\t\t";
        // line 4
        $context["__internal_1a9e9409136941a304ea805a54fb67e617fbde8ff249f57ed17f1df1feaa19d0"] = $this->env->loadTemplate("form-elements/input.twig");
        // line 5
        echo "\t\t\t";
        echo $context["__internal_1a9e9409136941a304ea805a54fb67e617fbde8ff249f57ed17f1df1feaa19d0"]->getinput((isset($context["id"]) ? $context["id"] : null), (isset($context["id"]) ? $context["id"] : null), 1, "checkbox", (isset($context["attributes"]) ? $context["attributes"] : null));
        echo "

\t\t\t";
        // line 7
        echo $this->getAttribute((isset($context["renderer"]) ? $context["renderer"] : null), "label");
        echo "

\t\t</label>
\t</div>
\t";
        // line 11
        if ($this->getAttribute((isset($context["renderer"]) ? $context["renderer"] : null), "help", array(), "any", true, true)) {
            // line 12
            echo "\t\t<div class=\"ai1ec-help-block\">";
            echo $this->getAttribute((isset($context["renderer"]) ? $context["renderer"] : null), "help");
            echo "</div>
\t";
        }
        // line 14
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "setting/checkbox.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 4,  53 => 17,  50 => 14,  36 => 10,  28 => 5,  23 => 3,  163 => 31,  152 => 29,  148 => 28,  144 => 27,  140 => 26,  136 => 25,  133 => 24,  127 => 22,  124 => 21,  109 => 20,  76 => 12,  45 => 4,  42 => 11,  97 => 17,  91 => 16,  88 => 32,  81 => 27,  77 => 26,  73 => 24,  71 => 11,  67 => 10,  60 => 18,  58 => 17,  48 => 5,  46 => 12,  39 => 2,  31 => 5,  29 => 5,  24 => 1,  168 => 36,  162 => 35,  156 => 33,  145 => 31,  141 => 30,  137 => 29,  134 => 28,  130 => 23,  121 => 24,  110 => 22,  106 => 21,  102 => 20,  99 => 19,  95 => 35,  90 => 17,  87 => 16,  83 => 14,  80 => 13,  74 => 13,  66 => 11,  63 => 9,  59 => 20,  55 => 7,  47 => 15,  44 => 12,  38 => 11,  21 => 1,  56 => 11,  51 => 6,  49 => 9,  43 => 11,  35 => 7,  30 => 3,  41 => 12,  34 => 6,  26 => 2,  22 => 2,  19 => 1,);
    }
}
