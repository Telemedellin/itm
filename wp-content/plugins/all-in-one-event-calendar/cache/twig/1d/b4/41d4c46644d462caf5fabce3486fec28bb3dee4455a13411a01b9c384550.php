<?php

/* setting/categories-color-picker.twig */
class __TwigTemplate_1db441d4c46644d462caf5fabce3486fec28bb3dee4455a13411a01b9c384550 extends Twig_Template
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
        if ((isset($context["edit"]) ? $context["edit"] : null)) {
            // line 2
            echo "\t<tr class=\"form-field\">
\t\t<th scope=\"row\" valign=\"top\">
\t\t\t<label for=\"tag-color\">
\t\t\t\t";
            // line 5
            echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "
\t\t\t</label>
\t\t</th>
\t\t<td>
\t\t\t<div id=\"tag-color\">
\t\t\t\t<div id=\"tag-color-background\" ";
            // line 10
            echo (isset($context["style"]) ? $context["style"] : null);
            echo "></div>
\t\t\t</div>
\t\t\t<input type=\"hidden\" name=\"tag-color-value\" id=\"tag-color-value\"
\t\t\t\tvalue=\"";
            // line 13
            echo twig_escape_filter($this->env, (isset($context["color"]) ? $context["color"] : null), "html", null, true);
            echo "\">
\t\t\t<p class=\"description\">";
            // line 14
            echo (isset($context["description"]) ? $context["description"] : null);
            echo ".</p>
\t\t</td>
\t</tr>
";
        } else {
            // line 18
            echo "\t<div class=\"form-field\">
\t\t<label for=\"tag-color\">
\t\t\t";
            // line 20
            echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "
\t\t</label>
\t\t<div id=\"tag-color\">
\t\t\t<div id=\"tag-color-background\"></div>
\t\t</div>
\t\t<input type=\"hidden\" name=\"tag-color-value\" id=\"tag-color-value\" value=\"\">
\t\t<p>";
            // line 26
            echo (isset($context["description"]) ? $context["description"] : null);
            echo ".</p>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "setting/categories-color-picker.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 26,  55 => 20,  51 => 18,  40 => 13,  34 => 10,  26 => 5,  69 => 19,  63 => 16,  59 => 15,  56 => 14,  54 => 13,  41 => 8,  39 => 7,  35 => 6,  30 => 5,  25 => 4,  21 => 2,  134 => 26,  120 => 25,  117 => 24,  114 => 23,  109 => 20,  95 => 19,  92 => 18,  75 => 17,  68 => 14,  62 => 12,  60 => 11,  52 => 7,  47 => 10,  44 => 14,  27 => 4,  22 => 2,  19 => 1,);
    }
}
