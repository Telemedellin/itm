<?php

/* setting/categories-image.twig */
class __TwigTemplate_b69bc1a2e974a2cc888cbb54b361d86981c0c2cc33fd8a93ba2368fb485deacb extends Twig_Template
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
            echo "
\t<tr class=\"form-field\">
\t\t<th scope=\"row\" valign=\"top\">
\t\t\t<label for=\"tag-color\">
\t\t\t\t";
            // line 6
            echo (isset($context["section_name"]) ? $context["section_name"] : null);
            echo "
\t\t\t</label>
\t\t</th>
\t\t<td>

\t\t\t<img src='";
            // line 11
            echo twig_escape_filter($this->env, (isset($context["image_src"]) ? $context["image_src"] : null), "html", null, true);
            echo "' ";
            echo twig_escape_filter($this->env, (isset($context["image_style"]) ? $context["image_style"] : null), "html", null, true);
            echo " alt='' id='ai1ec_category_imag_preview' />
\t\t\t<input type=\"hidden\" name=\"ai1ec_category_image_url\" id=\"ai1ec_category_image_url\" value=\"\">
\t\t\t<input class=\"button at-upload_image_button\" type=\"button\" id='ai1ec_category_image_uploader' value=\"";
            // line 13
            echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "\">

\t\t\t";
            // line 15
            if ((isset($context["image_src"]) ? $context["image_src"] : null)) {
                // line 16
                echo "\t\t\t<p>
\t\t\t\t<input type=\"checkbox\" style=\"width:auto;\" name=\"ai1ec_category_image_url_remove\" id=\"ai1ec_category_image_url_remove\" value=\"1\" />
\t\t\t\t<label for=\"ai1ec_category_image_url_remove\">";
                // line 18
                echo twig_escape_filter($this->env, (isset($context["remove_label"]) ? $context["remove_label"] : null), "html", null, true);
                echo "</label>
\t\t\t</p>
\t\t\t";
            }
            // line 21
            echo "
\t\t\t<div class=\"desc-field\">
\t\t\t\t<p class=\"description\">
\t\t\t\t\t";
            // line 24
            echo (isset($context["description"]) ? $context["description"] : null);
            echo "
\t\t\t\t</p>
\t\t\t</div>
\t\t</td>
\t</tr>

";
        } else {
            // line 31
            echo "\t<div class=\"form-field\">
\t\t<label for=\"ai1ec_image_field_id\">
\t\t\t";
            // line 33
            echo (isset($context["section_name"]) ? $context["section_name"] : null);
            echo "
\t\t</label>

\t\t<img src='";
            // line 36
            echo twig_escape_filter($this->env, (isset($context["image_src"]) ? $context["image_src"] : null), "html", null, true);
            echo "' ";
            echo twig_escape_filter($this->env, (isset($context["image_style"]) ? $context["image_style"] : null), "html", null, true);
            echo " alt='' id='ai1ec_category_imag_preview' />
\t\t<input type=\"hidden\" name=\"ai1ec_category_image_url\" id=\"ai1ec_category_image_url\" value=\"\">
\t\t<input class=\"button at-upload_image_button\" type=\"button\" id='ai1ec_category_image_uploader' value=\"";
            // line 38
            echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "\">

\t\t<div class=\"desc-field\">
\t\t\t<p class=\"description\">
\t\t\t\t";
            // line 42
            echo (isset($context["description"]) ? $context["description"] : null);
            echo "
\t\t\t</p>
\t\t</div>
\t</div>

";
        }
    }

    public function getTemplateName()
    {
        return "setting/categories-image.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 42,  91 => 38,  84 => 36,  78 => 33,  74 => 31,  53 => 18,  49 => 16,  42 => 13,  64 => 24,  55 => 20,  51 => 18,  40 => 13,  34 => 10,  26 => 5,  69 => 19,  63 => 16,  59 => 21,  56 => 14,  54 => 13,  41 => 8,  39 => 7,  35 => 11,  30 => 5,  25 => 4,  21 => 2,  134 => 26,  120 => 25,  117 => 24,  114 => 23,  109 => 20,  95 => 19,  92 => 18,  75 => 17,  68 => 14,  62 => 12,  60 => 11,  52 => 7,  47 => 15,  44 => 14,  27 => 6,  22 => 2,  19 => 1,);
    }
}
