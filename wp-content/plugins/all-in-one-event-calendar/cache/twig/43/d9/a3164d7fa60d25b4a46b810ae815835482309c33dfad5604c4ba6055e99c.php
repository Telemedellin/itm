<?php

/* organize/header.twig */
class __TwigTemplate_43d9a3164d7fa60d25b4a46b810ae815835482309c33dfad5604c4ba6055e99c extends Twig_Template
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
        echo "<div class=\"timely ai1ec-taxonomy-header ai1ec-hide\">
\t<h1>";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["text_title"]) ? $context["text_title"] : null), "html", null, true);
        echo "</h1>
\t<ul class=\"ai1ec-nav ai1ec-nav-tabs\">
\t\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["taxonomies"]) ? $context["taxonomies"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["taxonomy"]) {
            // line 5
            echo "\t\t\t";
            if ((!twig_test_empty($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "children")))) {
                // line 6
                echo "\t\t\t\t<li class=\"";
                if ($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "active")) {
                    echo "ai1ec-active";
                }
                // line 7
                echo "\t\t\t\t\tai1ec-taxonomy-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "taxonomy_name"), "html", null, true);
                echo "
\t\t\t\t\tai1ec-dropdown\" role=\"presentation\">
\t\t\t\t\t<a data-toggle=\"ai1ec-dropdown\" href=\"#\" class=\"ai1ec-dropdown-toggle\"
\t\t\t\t\t\trole=\"button\" aria-expanded=\"false\">
\t\t\t\t\t\t";
                // line 11
                if ((!twig_test_empty($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "icon")))) {
                    // line 12
                    echo "\t\t\t\t\t\t\t<i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "icon"), "html_attr");
                    echo " ai1ec-fa-fw\"></i>
\t\t\t\t\t\t";
                }
                // line 14
                echo "\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "name"), "html", null, true);
                echo " <span class=\"ai1ec-caret\"></span>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"ai1ec-dropdown-menu\" role=\"menu\">
\t\t\t\t\t\t";
                // line 17
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["taxonomy"]) ? $context["taxonomy"] : null), "children"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["taxonomy2"]) {
                    // line 18
                    echo "\t\t\t\t\t\t\t";
                    $this->env->loadTemplate("organize/tab.twig")->display(array_merge($context, array("taxonomy" => (isset($context["taxonomy2"]) ? $context["taxonomy2"] : null))));
                    // line 19
                    echo "\t\t\t\t\t\t";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['taxonomy2'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                echo "\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t";
            } else {
                // line 23
                echo "\t\t\t\t";
                $this->env->loadTemplate("organize/tab.twig")->display($context);
                // line 24
                echo "\t\t\t";
            }
            // line 25
            echo "\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['taxonomy'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "\t</ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "organize/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 26,  120 => 25,  117 => 24,  114 => 23,  109 => 20,  95 => 19,  92 => 18,  75 => 17,  68 => 14,  62 => 12,  60 => 11,  52 => 7,  47 => 6,  44 => 5,  27 => 4,  22 => 2,  19 => 1,);
    }
}
