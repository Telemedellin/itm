<?php

/* setting/select.twig */
class __TwigTemplate_eeeaebb8da9bb78c051017293e6e38b7b9b5b9ce2693c48fc571b498eaf0027d extends Twig_Template
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
        echo "<label class=\"ai1ec-control-label ";
        if ((!(isset($context["stacked"]) ? $context["stacked"] : null))) {
            echo "ai1ec-col-sm-5";
        }
        echo "\"
  for=\"";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "\">
\t";
        // line 3
        echo (isset($context["label"]) ? $context["label"] : null);
        echo "
</label>
<div ";
        // line 5
        if ((!(isset($context["stacked"]) ? $context["stacked"] : null))) {
            echo "class=\"ai1ec-col-sm-7\"";
        }
        echo ">
  ";
        // line 6
        $context["__internal_1e7b9caf36accc03c0442ff2ff320ff34c9f37dce1dbaf01db414653933dae2e"] = $this->env->loadTemplate("form-elements/select.twig");
        // line 7
        echo "  ";
        echo $context["__internal_1e7b9caf36accc03c0442ff2ff320ff34c9f37dce1dbaf01db414653933dae2e"]->getselect((isset($context["id"]) ? $context["id"] : null), (isset($context["name"]) ? $context["name"] : null), (isset($context["attributes"]) ? $context["attributes"] : null), (isset($context["options"]) ? $context["options"] : null));
        echo "
</div>
";
        // line 9
        if ((!twig_test_empty((isset($context["fieldsets"]) ? $context["fieldsets"] : null)))) {
            // line 10
            echo "  ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["fieldsets"]) ? $context["fieldsets"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["fieldset"]) {
                // line 11
                echo "    ";
                echo (isset($context["fieldset"]) ? $context["fieldset"] : null);
                echo "
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fieldset'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "setting/select.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 9,  35 => 5,  30 => 3,  26 => 2,  19 => 1,  51 => 10,  47 => 12,  41 => 6,  36 => 6,  32 => 5,  27 => 3,  23 => 2,  20 => 1,  56 => 11,  52 => 11,  46 => 8,  43 => 7,  40 => 6,  38 => 5,  34 => 4,  31 => 3,  28 => 2,);
    }
}
