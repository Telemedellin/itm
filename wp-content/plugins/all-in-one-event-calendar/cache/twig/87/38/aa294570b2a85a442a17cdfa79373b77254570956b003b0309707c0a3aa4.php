<?php

/* select2_input.twig */
class __TwigTemplate_8738aa294570b2a85a442a17cdfa79373b77254570956b003b0309707c0a3aa4 extends Twig_Template
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
        $context["__internal_3006595bf8b698bbb3aba56d1d08c6bae5ed1b7fd6040eaa6332c46f77abf97b"] = $this->env->loadTemplate("form-elements/input.twig");
        // line 2
        echo $context["__internal_3006595bf8b698bbb3aba56d1d08c6bae5ed1b7fd6040eaa6332c46f77abf97b"]->getinput((isset($context["id"]) ? $context["id"] : null), (isset($context["name"]) ? $context["name"] : null), "", "text", (isset($context["select2_args"]) ? $context["select2_args"] : null));
    }

    public function getTemplateName()
    {
        return "select2_input.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  35 => 7,  33 => 6,  30 => 5,  24 => 3,  22 => 2,  19 => 1,);
    }
}
