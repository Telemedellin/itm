<?php

/* organize/tab.twig */
class __TwigTemplate_2e4133d05bb6c6796937bc9a3340d448d39d5e6c81ad15c2e3e8d9fa2be2d09b extends Twig_Template
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
        if ($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "divider")) {
            // line 2
            echo "\t<li role=\"presentation\" class=\"ai1ec-divider\"></li>
";
        } else {
            // line 4
            echo "\t<li class=\"";
            if ($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "active")) {
                echo "ai1ec-active";
            }
            // line 5
            echo "\t\tai1ec-taxonomy-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "taxonomy_name"), "html", null, true);
            echo "\">
\t\t<a href=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "url"), "html_attr");
            echo "\">
\t\t";
            // line 7
            if ((!twig_test_empty($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "icon")))) {
                // line 8
                echo "\t\t\t<i class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "icon"), "html_attr");
                echo " ai1ec-fa-fw\"></i>
\t\t";
            }
            // line 10
            echo "\t\t";
            echo $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "name");
            echo "
\t\t</a>

\t\t";
            // line 13
            if (($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "active") && (!twig_test_empty($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "edit_url"))))) {
                // line 14
                echo "\t\t\t<a class=\"ai1ec-taxonomy-edit-link ai1ec-hide button button-primary timely\"
\t\t\t\thref=\"";
                // line 15
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "edit_url"), "html_attr");
                echo "\">
\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-pencil\"></i> ";
                // line 16
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "edit_label"), "html", null, true);
                echo "
\t\t\t</a>
\t\t";
            }
            // line 19
            echo "\t</li>
";
        }
    }

    public function getTemplateName()
    {
        return "organize/tab.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 19,  63 => 16,  59 => 15,  56 => 14,  54 => 13,  41 => 8,  39 => 7,  35 => 6,  30 => 5,  25 => 4,  21 => 2,  134 => 26,  120 => 25,  117 => 24,  114 => 23,  109 => 20,  95 => 19,  92 => 18,  75 => 17,  68 => 14,  62 => 12,  60 => 11,  52 => 7,  47 => 10,  44 => 5,  27 => 4,  22 => 2,  19 => 1,);
    }
}
