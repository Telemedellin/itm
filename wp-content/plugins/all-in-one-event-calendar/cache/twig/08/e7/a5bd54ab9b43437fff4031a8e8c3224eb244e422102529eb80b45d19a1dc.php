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
        $context["__internal_4f3644ff9b8d8adca7652142b40fd0e966274254cb6c30250a034a19b10c6086"] = $this->env->loadTemplate("form-elements/input.twig");
        // line 4
        echo "  <div class=\"ai1ec-text-right\">
    ";
        // line 5
        echo $context["__internal_4f3644ff9b8d8adca7652142b40fd0e966274254cb6c30250a034a19b10c6086"]->getbutton($this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "id"), $this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "id"), $this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "value"), "submit", $this->getAttribute((isset($context["submit"]) ? $context["submit"] : null), "args"));
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
        return array (  42 => 9,  80 => 14,  74 => 13,  55 => 8,  35 => 7,  21 => 1,  68 => 21,  66 => 11,  62 => 18,  59 => 9,  50 => 13,  44 => 5,  39 => 9,  30 => 5,  137 => 38,  133 => 37,  127 => 34,  123 => 33,  114 => 30,  110 => 29,  102 => 28,  96 => 27,  91 => 25,  87 => 24,  79 => 23,  73 => 22,  63 => 10,  57 => 15,  37 => 5,  29 => 7,  129 => 53,  119 => 32,  115 => 48,  108 => 44,  104 => 43,  97 => 39,  93 => 38,  86 => 34,  82 => 33,  75 => 29,  71 => 27,  67 => 19,  60 => 22,  48 => 19,  33 => 8,  22 => 2,  24 => 2,  19 => 1,  51 => 7,  47 => 11,  41 => 4,  36 => 8,  32 => 6,  27 => 3,  23 => 3,  20 => 1,  56 => 21,  52 => 13,  46 => 12,  43 => 9,  40 => 14,  38 => 3,  34 => 4,  31 => 3,  28 => 2,);
    }
}
