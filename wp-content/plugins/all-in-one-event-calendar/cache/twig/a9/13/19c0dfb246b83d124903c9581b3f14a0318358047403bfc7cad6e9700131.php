<?php

/* theme-options/font.twig */
class __TwigTemplate_a91319c0dfb246b83d124903c9581b3f14a0318358047403bfc7cad6e9700131 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("theme-options/base_option.twig");

        $this->blocks = array(
            'variable' => array($this, 'block_variable'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "theme-options/base_option.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["__internal_aa8631270f49ad432c2ad4245266cde2550bf66c7575e4bf3f7565745ce6a6fe"] = $this->env->loadTemplate("form-elements/select.twig");
        // line 3
        $context["__internal_66fba7ce6dd72f26bc9706c0b1f1a9fc7e5a676190e8ebdf46800ab7e9c4dae3"] = $this->env->loadTemplate("form-elements/input.twig");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_variable($context, array $blocks = array())
    {
        // line 5
        echo "  <div class=\"ai1ec-col-sm-6 ai1ec-col-xs-9\">
    ";
        // line 6
        echo $context["__internal_aa8631270f49ad432c2ad4245266cde2550bf66c7575e4bf3f7565745ce6a6fe"]->getselect($this->getAttribute((isset($context["select"]) ? $context["select"] : null), "id"), $this->getAttribute((isset($context["select"]) ? $context["select"] : null), "id"), $this->getAttribute((isset($context["select"]) ? $context["select"] : null), "args"), $this->getAttribute((isset($context["select"]) ? $context["select"] : null), "options"));
        echo "
    ";
        // line 7
        echo $context["__internal_66fba7ce6dd72f26bc9706c0b1f1a9fc7e5a676190e8ebdf46800ab7e9c4dae3"]->getinput($this->getAttribute((isset($context["input"]) ? $context["input"] : null), "id"), $this->getAttribute((isset($context["input"]) ? $context["input"] : null), "id"), $this->getAttribute((isset($context["input"]) ? $context["input"] : null), "value"), "text", $this->getAttribute((isset($context["input"]) ? $context["input"] : null), "args"));
        echo "
  </div>
";
    }

    public function getTemplateName()
    {
        return "theme-options/font.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 7,  38 => 6,  35 => 5,  25 => 2,  39 => 5,  32 => 4,  27 => 3,  23 => 2,  20 => 1,  58 => 12,  51 => 10,  45 => 9,  41 => 8,  37 => 7,  33 => 5,  34 => 6,  31 => 4,  28 => 3,);
    }
}
