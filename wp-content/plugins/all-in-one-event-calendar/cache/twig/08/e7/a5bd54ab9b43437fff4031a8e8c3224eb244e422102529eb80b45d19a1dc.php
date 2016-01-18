<?php

/* setting/bootstrap_tabs.twig */
class __TwigTemplate_08e7a5bd54ab9b43437fff4031a8e8c3224eb244e422102529eb80b45d19a1dc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("bootstrap_tabs.twig");

        $this->blocks = array(
            'extra_html' => array($this, 'block_extra_html'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "bootstrap_tabs.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_extra_html($context, array $blocks = array())
    {
        // line 3
        echo "  ";
        $context["__internal_851b949ec1c59dc9bd964002076af98fa1a9815ba56ae40c3e49cd1eac8fa484"] = $this->env->loadTemplate("form-elements/input.twig");
        // line 4
        echo "  <div class=\"ai1ec-text-right\">
    ";
        // line 5
        echo $context["__internal_851b949ec1c59dc9bd964002076af98fa1a9815ba56ae40c3e49cd1eac8fa484"]->getbutton($this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "id"), $this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "id"), $this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "value"), "submit", $this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "args"));
        echo "
  </div>
";
    }

    public function getTemplateName()
    {
        return "setting/bootstrap_tabs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 21,  62 => 18,  123 => 33,  114 => 30,  96 => 27,  79 => 23,  57 => 15,  37 => 5,  50 => 13,  163 => 31,  152 => 29,  148 => 28,  144 => 27,  140 => 26,  136 => 25,  133 => 37,  127 => 34,  124 => 21,  109 => 20,  76 => 12,  45 => 4,  42 => 9,  91 => 25,  88 => 32,  81 => 27,  77 => 26,  73 => 22,  58 => 17,  39 => 9,  29 => 7,  24 => 2,  129 => 53,  119 => 32,  115 => 48,  108 => 44,  104 => 43,  97 => 17,  93 => 38,  86 => 34,  82 => 33,  75 => 29,  71 => 11,  67 => 19,  60 => 18,  48 => 5,  33 => 8,  22 => 2,  168 => 36,  162 => 35,  156 => 33,  145 => 31,  141 => 30,  137 => 38,  134 => 28,  130 => 23,  121 => 24,  110 => 29,  106 => 21,  102 => 28,  99 => 19,  95 => 35,  90 => 17,  87 => 24,  83 => 14,  80 => 14,  74 => 13,  66 => 11,  63 => 10,  59 => 9,  55 => 8,  44 => 5,  21 => 1,  49 => 9,  35 => 7,  30 => 5,  26 => 2,  19 => 1,  51 => 7,  47 => 11,  41 => 4,  36 => 8,  32 => 6,  27 => 4,  23 => 3,  20 => 1,  56 => 21,  52 => 13,  46 => 12,  43 => 11,  40 => 14,  38 => 3,  34 => 4,  31 => 3,  28 => 2,);
    }
}
